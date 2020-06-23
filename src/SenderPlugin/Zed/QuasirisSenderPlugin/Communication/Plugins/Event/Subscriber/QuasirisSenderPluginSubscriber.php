<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Quasiris\Zed\QuasirisSenderPlugin\Communication\Plugins\Event\Subscriber;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Product\Dependency\ProductEvents;
use Generated\Shared\Transfer\ProductAbstractTransfer;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductStorage\Communication\Plugin\Event\Subscriber\ProductStorageEventSubscriber as SprykerProductStorageEventSubscriber;

use ProductBundle\Dependency\ProductBundleEvents;
use Quasiris\Zed\QuasirisSenderPlugin\Communication\Plugins\Event\Listener\QuasirisSenderPluginListener;
use Quasiris\Zed\QuasirisSenderPlugin\Communication\Plugins\Event\Listener\QuasirisSenderPluginPublishListener;

/**
 * Sample implementation for subscriber
 */
class QuasirisSenderPluginSubscriber extends SprykerProductStorageEventSubscriber
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $eventCollection = parent::getSubscribedEvents($eventCollection);
        $eventCollection = $this->createProductListener($eventCollection);
        $eventCollection = $this->updateProductListener($eventCollection);
        $eventCollection = $this->productAbstractPublishListener($eventCollection);

        return $eventCollection;
    }

    private function createProductListener(EventCollectionInterface $eventCollection): EventCollectionInterface {
        $eventCollection->addListenerQueued(ProductEvents::PRODUCT_ABSTRACT_AFTER_CREATE, new QuasirisSenderPluginListener());
        // $eventCollection->addListenerQueued(ProductEvents::PRODUCT_CONCRETE_AFTER_CREATE, new QuasirisSenderPlugin());

        return $eventCollection;
    }

    private function updateProductListener(EventCollectionInterface $eventCollection): EventCollectionInterface {

        $eventCollection->addListenerQueued(ProductEvents::PRODUCT_ABSTRACT_AFTER_UPDATE, new QuasirisSenderPluginListener());
        // $eventCollection->addListenerQueued(ProductEvents::PRODUCT_CONCRETE_AFTER_UPDATE, new QuasirisSenderPlugin());
        return $eventCollection;
    }


    private function productAbstractPublishListener(EventCollectionInterface $eventCollection): EventCollectionInterface {
        $eventCollection->addListenerQueued(ProductEvents::PRODUCT_ABSTRACT_PUBLISH, new QuasirisSenderPluginPublishListener());
        return $eventCollection;
    }

    private function deleteProductListener(EventCollectionInterface $eventCollection): EventCollectionInterface {
        $eventCollection->addListenerQueued(ProductEvents::ENTITY_SPY_PRODUCT_DELETE, new QuasirisSenderPluginListener());
        return $eventCollection;
    }
}