# Spryker - QuasirisSenderPlugin

This library is used to catching events about product (abstract, concrete) as like:
- creating, 
- updating, 
- publishing, 
- unpublishing

And sending it to custom api url (POST method).

Data comes to api 

```json
API_URL_MAIN:
{
   "product": {
      "abstract": {
         //info about abstract of product"
      },
      "concrete": {
         //info about concrete of product"}
      },
      "categories": {
         "categories": [//info about categories of product"]
      }
   }
}
API_URL_TESTING:
{
    "status": "SUCCESS",
    "params": {
        "date": "23.06.20 10:26:06",
        "listenerName": "QuasirisSenderPlugin",
        "eventName": "Product.product_abstract.after.update",
        "abstract": {
            
        },
        "concrete": [],
        "categories": {
            "categories": []
        },
        "productId": //id of product,
        "type": "products"
    },
    "eventName": "Product.product_abstract.after.update",
    "response_from_main_api": {},
    "url_main_api": API_URL_MAIN,
    "url_testing_api": API_URL_TESTING,
    "product_id": //id of product
}

```

## Installation

If you dont have install composer go to [composer website](https://getcomposer.org/download/) and install it.

Type in your project terminal:

```bash
composer require quasiris/quasiris-sender-plugin
```

## Usage

After installation, go to Pyz\Zed\Event\EventDependencyProvider.php;

Import subscriber:

```php
use Quasiris\Zed\QuasirisSenderPlugin\Communication\Plugins\Event\Subscriber\QuasirisSenderPluginSubscriber;

```

next in getEventSubscriberCollection() method, above return $eventSubscriberCollection;, register events to watch:

```php
$eventSubscriberCollection->add(new QuasirisSenderPluginSubscriber());

```

All implementation Pyz\Zed\Event\EventDependencyProvider.php:

```php
<?php
// Pyz\Zed\Event\EventDependencyProvider.php
namespace Pyz\Zed\Event;

use ...;
.
.
.
use Quasiris\Zed\QuasirisSenderPlugin\Communication\Plugins\Event\Subscriber\QuasirisSenderPluginSubscriber;

class EventDependencyProvider extends SprykerEventDependencyProvider
{
    /**
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getEventListenerCollection()
    {
        return parent::getEventListenerCollection();
    }

    /**
     * @return \Spryker\Zed\Event\Dependency\EventSubscriberCollectionInterface
     */
    public function getEventSubscriberCollection()
    {
        .
        .
        .
        .
        .
        $eventSubscriberCollection->add(new QuasirisSenderPluginSubscriber());

        return $eventSubscriberCollection;
    }
}

```

Next go to config/Shared/config_default.php

Import constant from plugin and add constant:

```php
// config/Shared/config_default.php
use Quasiris\Zed\QuasirisSenderPlugin\Shared\QuasirisSenderPluginConstants;

$config[QuasirisSenderPluginConstants::MY_SETTING] = [
    'API_URL_MAIN' => 'main url where data goes',
    'API_URL_TESTING' => 'testing url where data goes with additional informations'
];
```

Info: 
API_URL_MAIN and API_URL_TESTING working separatly you can add only one of them  ex.
```php
// config/Shared/config_default.php
use Quasiris\Zed\QuasirisSenderPlugin\Shared\QuasirisSenderPluginConstants;

$config[QuasirisSenderPluginConstants::MY_SETTING] = [
    'API_URL_MAIN' => 'main url where data goes'
];
------------------------ Different example ------------------------------
// config/Shared/config_default.php
use Quasiris\Zed\QuasirisSenderPlugin\Shared\QuasirisSenderPluginConstants;

$config[QuasirisSenderPluginConstants::MY_SETTING] = [
    'API_URL_TESTING' => 'testing url where data goes with additional informations'
];
```

## License
[MIT](https://choosealicense.com/licenses/mit/)