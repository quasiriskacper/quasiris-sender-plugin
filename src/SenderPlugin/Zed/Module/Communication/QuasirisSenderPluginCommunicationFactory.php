<?php

namespace quasiris\QuasirisSenderPlugin\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use quasiris\QuasirisSenderPlugin\QuasirisSenderPluginDependencyProvider;


class QuasirisSenderPluginCommunicationFactory extends AbstractCommunicationFactory
{
    public function getProductFacede() {
        return $this->getProvidedDependency(QuasirisSenderPluginDependencyProvider::FACADE_PRODUCT);
    }

    public function getProductCategoryFacede() {
        return $this->getProvidedDependency(QuasirisSenderPluginDependencyProvider::FACADE_PRODUCT_CATEGORY);
    }

    public function getLocaleFacede() {
        return $this->getProvidedDependency(QuasirisSenderPluginDependencyProvider::FACADE_LOCALE);
    }

    public function getEventBehaviorFacade()
    {
        return $this->getProvidedDependency(QuasirisSenderPluginDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}
