<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SenderPlugin\Zed\Module\Communication\Plugins\Event\Listener;

use Orm\Zed\ProductBundle\Persistence\Map\SpyProductBundleTableMap;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SenderPlugin\Zed\Module\QuasirisSenderPluginDependencyProvider;
use SenderPlugin\Zed\Module\Communication\Controllers\SenderController;
use SenderPlugin\Zed\Module\Communication\QuasirisSenderPluginCommunicationFactory;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;
use Spryker\Zed\Product\Business\ProductFacade;

/**
 * @method \Spryker\Zed\ProductRelation\Business\ProductRelationFacade getFacade()
 * @method \Spryker\Zed\ProductRelation\Communication\ProductRelationCommunicationFactory getFactory()
 */
class QuasirisSenderPluginPublishListener extends AbstractPlugin implements EventBulkHandlerInterface


{
    use DatabaseTransactionHandlerTrait;
    private $sender;

    public function __construct() {
        $this->sender = new SenderController();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface|\Generated\Shared\Transfer\ProductAbstractTransfer $eventTransfer
     *
     * @return void
     */
    public function handleBulk(array $eventTransfers, $eventName): void
    {   
        $productInfo = [];
    
        $productAbstractIds = $this->getFactory()->getEventBehaviorFacade()->getEventTransferIds($eventTransfers);
        if (empty($productAbstractIds)) {
            return;
        }

        foreach($productAbstractIds as $p) {
            $productInfo[] =  $this->getQueryContainer()->findProductAbstractById($p)->toArray();
        }
            
        $data = array(
            'date' => date('d.m.y G:i:s'),
            'listenerName' => 'QuasirisSenderPluginPublishListener',
            'eventName' =>  $eventName,
            'eventTransfers' => $productInfo,
        );
        $this->sender->getDataFromApi($data, $this->getConfig()->getMySetting());
        
    }
    
}
