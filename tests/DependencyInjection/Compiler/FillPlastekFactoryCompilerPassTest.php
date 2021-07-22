<?php

namespace Malinoff\PlastekBundle\Tests\DependencyInjection\Compiler;

use Malinoff\PlastekBundle\DependencyInjection\Compiler\FillPlastekFactoryCompilerPass;
use Malinoff\PlastekBundle\Services\PlastekFactory;
use Malinoff\PlastekBundle\Tests\KernelTestCase;
use Malinoff\PlastekBundle\Tests\mocks\ServiceWithFillPlastekFactory;
use Malinoff\PlastekBundle\Tests\mocks\ServiceWithoutFillPlastekFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FillPlastekFactoryCompilerPassTest extends KernelTestCase
{
    public function testProcessWithoutPlastekFactory()
    {
        $container = new ContainerBuilder();

        $this->expectException(\RuntimeException::class);

        $this->process($container);
    }

    public function testProcessUncorrectServicesPlastekFactoryTag()
    {
        $container = new ContainerBuilder();
        $container->register(PlastekFactory::class);

        $serviceIds = [
            'service_1_without_fill_plastek_factory_interface',
            'service_2_without_fill_plastek_factory_interface',
            'service_3_without_fill_plastek_factory_interface',
        ];

        foreach ($serviceIds as $serviceId) {
            $container
                ->register($serviceId)
                ->setClass(ServiceWithoutFillPlastekFactory::class)
                ->addTag('malinoff.fill_plastek_factory_tag');
        }

        $this->expectException(\RuntimeException::class);

        $this->process($container);
    }

    public function testProcessCorrectServicesPlastekFactoryTag()
    {
        $container = new ContainerBuilder();

        $container->register(PlastekFactory::class);

        $serviceIds = [
            'service_1_implements_fill_plastek_factory_interface',
            'service_2_implements_fill_plastek_factory_interface',
            'service_3_implements_fill_plastek_factory_interface',
        ];

        foreach ($serviceIds as $serviceId) {
            $container
                ->register($serviceId)
                ->setClass(ServiceWithFillPlastekFactory::class)
                ->addTag('malinoff.fill_plastek_factory_tag');
        }

        $this->process($container);

        $methodCalls = $container->getDefinition(PlastekFactory::class)->getMethodCalls();

        $this->assertCount(count($serviceIds), $methodCalls);

        foreach ($methodCalls as $methodCall) {
            $this->assertSame('fillMap', $methodCall[0]);
            $this->assertTrue(in_array((string) $methodCall[1][0], $serviceIds));
        }
    }

    protected function process(ContainerBuilder $container)
    {
        (new FillPlastekFactoryCompilerPass())->process($container);
    }
}
