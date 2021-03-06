<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services;

use Exception;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Malinoff\PlastekBundle\Services\Exception\ApiException;
use Malinoff\PlastekBundle\Services\Exception\EmptyResponseException;
use Malinoff\PlastekBundle\Services\Exception\ErrorResponse;
use Malinoff\PlastekBundle\Services\Exception\NotFoundException;
use Malinoff\PlastekBundle\Services\Exception\PlastekException;
use Malinoff\PlastekBundle\Services\Request\RequestInterface;
use Malinoff\PlastekBundle\Services\Response\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Client for https://delivery-svc.plas-tek.ru/CoreDelivery/api-docs/index.html.
 */
class PlastekClient
{
    public const KEY_METHOD = 'method';

    public const KEY_TOKEN = 'token';

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var PlastekFactory
     */
    private $plastekFactory;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        Configuration $configuration,
        PlastekFactory $plastekFactory,
        HttpClientInterface $httpClient,
        LoggerInterface $logger,
        ValidatorInterface $validator
    ) {
        $this->configuration = $configuration;
        $this->plastekFactory = $plastekFactory;
        $this->httpClient = $httpClient;
        $this->logger = $logger;
        $this->validator = $validator;
        $this->serializer = SerializerBuilder::create()->build();
    }

    public static function getUuidOrder(): string
    {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535)
        );
    }

    /**
     * @throws ValidatorException
     * @throws EmptyResponseException
     * @throws NotFoundException
     * @throws PlastekException
     * @throws Exception
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $version = $this->configuration->getVersion();
        $uuid = uniqid();
        $ticks = $this->getTicks();

        $request->setVersion($version);
        $request->setUuid($uuid);
        $request->setTicks((string) $ticks);

        $errors = $this->validateEntity($request, ['request']);

        if (!empty($errors)) {
            throw new ValidatorException(implode('; ', $errors));
        }

        try {
            $responseData = $this->sendRequest(
                $request->getMethod(),
                $this->configuration->getApiUrl().$request->getAction(),
                $this->prepareHeaders([
                    self::KEY_METHOD => $request->getMethod(),
                    self::KEY_TOKEN => hash_hmac(
                        'sha256',
                        sprintf('%s;%s', $uuid, $ticks),
                        mb_strtolower($this->configuration->getPassword())
                    ),
                ]),
                $request->getQuery(),
                $this->serializer->serialize(
                    $request->getBody(),
                    'json',
                    SerializationContext::create()->setGroups(['request'])
                )
            );

            if (empty($responseData)) {
                throw new EmptyResponseException();
            }

            if (null === json_decode($responseData, true)) {
                throw new Exception('Error decoding json-response Plastek');
            }

            return $this->serializer->deserialize(
                $responseData,
                get_class($this->plastekFactory->createResponse($request)),
                'json',
                DeserializationContext::create()->setGroups(['response'])
            );
        } catch (ApiException $exception) {
            if (404 === (int) $exception->getCode()) {
                throw new NotFoundException();
            }

            $errorResponseText = json_decode($exception->getMessage(), true);

            if (null === $errorResponseText || empty($errorResponseText['error'])) {
                throw new Exception($exception->getMessage(), $exception->getCode(), $exception);
            }

            $errorResponseData = explode('#', $errorResponseText['error']);

            if (count($errorResponseData) < 3) {
                throw new Exception($errorResponseText['error'], $exception->getCode(), $exception);
            }

            $errorLevel = preg_replace('/[^0-9]/', '', $errorResponseData[0]);

            $idError = preg_replace('/[^0-9]/', '', $errorResponseData[1]);

            $errorResponse = (new ErrorResponse())
                ->setErrorLevel(null !== $errorLevel ? (int) $errorLevel : null)
                ->setIdError(null !== $idError ? (int) $idError : null)
                ->setText($errorResponseData[2]);

            throw new PlastekException($exception, $errorResponse);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * The function returns the number of 100-nanosecond intervals since 00:00:00 1 January 0001.
     */
    private function getTicks(): int
    {
        $d1 = strtotime('0001-01-01 00:00:00');
        $d1 = $d1 < 0 ? -$d1 : $d1;
        $d1 = $d1 * 10000;

        $d2 = microtime(true) * 10000;

        return ($d1 + (int) $d2) * 1000;
    }

    /**
     * @param mixed $entity
     */
    private function validateEntity($entity, array $validationGroups = []): array
    {
        $errors = [];

        /** @var ConstraintViolation $violation */
        foreach ($this->validator->validate($entity, null, $validationGroups) as $violation) {
            $errors[] = sprintf('%s: %s', $violation->getPropertyPath(), $violation->getMessage());
        }

        return $errors;
    }

    private function prepareHeaders(array $options = []): array
    {
        $headers = [];

        if (!empty($options[self::KEY_TOKEN])) {
            switch ($options[self::KEY_METHOD]) {
                case 'POST':
                case 'PUT':
                    $headers['Content-Type'] = 'application/json';

                    break;
            }
        }

        if (!empty($options[self::KEY_TOKEN])) {
            $headers['Authorization'] = sprintf('Bearer %s', $options[self::KEY_TOKEN]);
        }

        return $headers;
    }

    /**
     * @param array|string $body
     *
     * @throws ApiException
     * @throws Exception
     */
    private function sendRequest(string $method, string $url, array $headers, array $query = [], $body = []): string
    {
        $options = [
            'headers' => $headers,
            'query' => $query,
            'body' => $body,
            'timeout' => $this->configuration->getTimeout(),
        ];

        try {
            $response = $this->httpClient->request($method, $url, $options)->getContent();

            if ($this->configuration->isDebug()) {
                $this->logger->debug(sprintf(
                    'Plastek request is success [url=%s]: %s',
                    $url,
                    $response
                ), $options);
            }

            return $response;
        } catch (HttpExceptionInterface $exception) {
            $code = $exception->getCode();
            $message = $exception->getMessage();

            try {
                $code = $exception->getResponse()->getStatusCode();
                $message = $exception->getResponse()->getContent(false);
            } catch (ExceptionInterface $e) {
            }

            if ($this->configuration->isDebug()) {
                $this->logger->error(sprintf(
                    'Plastek request is http failure [url=%s]: %s: %s',
                    $url,
                    $code,
                    $message
                ), $options);
            }

            throw new ApiException($message, $code, $exception);
        } catch (ExceptionInterface $exception) {
            $code = $exception->getCode();
            $message = $exception->getMessage();

            if ($this->configuration->isDebug()) {
                $this->logger->error(sprintf(
                    'Plastek request is exception failure [url=%s]: %s',
                    $url,
                    $message
                ), $options);
            }

            throw new Exception($message, $code, $exception);
        }
    }
}
