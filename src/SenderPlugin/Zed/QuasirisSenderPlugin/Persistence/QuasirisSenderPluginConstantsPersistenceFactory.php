<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Quasiris\Zed\QuasirisSenderPlugin\Persistence;

use Orm\Zed\ProductStorage\Persistence\SpyProductAbstractStorageQuery;
use Orm\Zed\ProductStorage\Persistence\SpyProductConcreteStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Quasiris\Zed\QuasirisSenderPlugin\QuasirisSenderPluginDependencyProvider;


/**
 * @method \Spryker\Zed\ProductStorage\ProductStorageConfig getConfig()
 * @method \Spryker\Zed\ProductStorage\Persistence\ProductStorageQueryContainerInterface getQueryContainer()
 */
class QuasirisSenderPluginPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductStorage\Persistence\SpyProductAbstractStorageQuery
     */
    public function createSpyProductAbstractStorageQuery()
    {
        return SpyProductAbstractStorageQuery::create();
    }

    /**
     * @return \Orm\Zed\ProductStorage\Persistence\SpyProductConcreteStorageQuery
     */
    public function createSpyProductConcreteStorageQuery()
    {
        return SpyProductConcreteStorageQuery::create();
    }

    /**
     * @return \Spryker\Zed\ProductStorage\Dependency\QueryContainer\ProductStorageToProductQueryContainerInterface
     */
    public function getProductQueryContainer()
    {
        return $this->getProvidedDependency(QuasirisSenderPluginDependencyProvider::QUERY_CONTAINER_PRODUCT);
    }
}