# Plastek-bundle
Bundle for working with Plastek API (https://plas-tek.ru)

## Описание

Symfony Plastek Bundle предназначен для работы с API [Пластэк](https://plas-tek.ru).

## Установка

Данный бандл может быть установлен с помощью [Composer](https://getcomposer.org).

### Приложения, которые используют Symfony Flex

Откройте командную консоль, перейдите в каталог вашего проекта и выполните:

```bash
composer require a-malinoff/plastek-bundle
```

### Приложения, которые не используют Symfony Flex

#### Шаг #1: Загрузка бандла

Откройте командную консоль, перейдите в каталог вашего проекта и выполните следующую команду, чтобы загрузить последнюю
стабильную версию этого пакета:

```bash
composer require a-malinoff/plastek-bundle
```

#### Шаг #2: Активация бандла

Включите пакет, добавив его в список зарегистрированных пакетов в файле `app/AppKernel.php` вашего проекта:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Malinoff\PlastekBundle\MalinoffPlastekBundle(),
        );

        // ...
    }

    // ...
}
```

## Конфигурация

Создайте файл конфигурации `config/packages/platek.yaml`

### Пример

```yaml
malinoff_plastek:
  api_url: 'https://delivery-svc.plas-tek.ru/CoreDeliveryDebug'
  # https://delivery-svc.plas-tek.ru/CoreDeliveryDebug - Отладочный АПИ
  # https://delivery-svc.plas-tek.ru/CoreDelivery - Рабочий АПИ
  version: 'v1'
  password: ''
  # необходимо указать пароль, выданный сервисом Пластэк
  debug: false
  # По умолчанию режим отладки соответствует окружению (dev: debug=true, prod: debug=false)
  timeout: 20
```

## Использование

Прежде всего, необходимо подключить для работы сервис PlastekClient

```php
<?php

// ...

use Malinoff\PlastekBundle\Services\PlastekClient;

class BaseController extends AbstractController
{
    private $plastekClient;

    public function __construct(PlastekClient $plastekClient)
    {
        $this->plastekClient = $plastekClient;
    }
}
```

Для отправки запроса используется метод send. В данный метод передается объект, реализующий интерфейс ``Malinoff\PlastekBundle\Services\Request\RequestInterface``.

Объектом запроса может являться заполненный экземпляр одного из классов, расположенных в ``Malinoff\PlastekBundle\Services\Request``.

В ответ метод send вернет соответствующий объект ответа. (классы ответов тут - ``Malinoff\PlastekBundle\Services\Response``).

Связки классов запросов-ответов соответствуют АПИ-методам Пластек. 

Описание всех методов приводится в [документации](https://delivery-svc.plas-tek.ru/CoreDelivery/api-docs/index.html).

Дополнительно, предоставлена возможность создавать свои классы запросов и ответов (на случай, если не подойдёт имеющийся набор классов Requests - Responses)

Для этого зарегистрируйте сервис, реализующий интерфейс ``Malinoff\PlastekBundle\Services\FillPlastekFactoryInterface``

Сервис должен вернуть массив связок вида ```"Класс запроса" => "Класс ответа"```, например:

```php
public static function getMap(): array
    {
        return [
            FirstExampleRequest::class => FirstExampleResponse::class,
        ];
    }
```

## Лицензия

[MIT License](https://opensource.org/licenses/mit-license) © A-Malinoff