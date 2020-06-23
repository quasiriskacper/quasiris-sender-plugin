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
use SenderPlugin\Zed\Module\Communication\Controllers\SenderController;
use SenderPlugin\Zed\Module\Communication\Controllers\MixedController;

use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;


/**
 * @method \Spryker\Zed\ProductRelation\Business\ProductRelationFacade getFacade()
 * @method \Spryker\Zed\ProductRelation\Communication\ProductRelationCommunicationFactory getFactory()
 */
class QuasirisSenderPluginListener extends AbstractPlugin implements EventBulkHandlerInterface {
    use DatabaseTransactionHandlerTrait;
    private $sender;
    private $mixed;

    public function __construct() {
        $this->sender = new SenderController();
        $this->mixed = new MixedController();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface|\Generated\Shared\Transfer\ProductAbstractTransfer $eventTransfer
     *
     * @return void
     */
    public function handleBulk(array $eventTransfers, $eventName): void
    {   
        $productInfo = [];
        $concrete = [];

        foreach ($eventTransfers as $eventTransfer) {
            $productInfo[] = $eventTransfer->toArray();
        }
        $getCorrectAbstractConcreteProductIds = $this->mixed->getCorrectAbstractConcreteProductIds($productInfo, true);
        $id = $getCorrectAbstractConcreteProductIds['id'];
        $type = $getCorrectAbstractConcreteProductIds['type'];
       
        foreach($id as $i) {
            $abstract = $this->getFactory()->getProductFacede()->findProductAbstractById($i)->toArray();
            $getConcreteProductsByAbstractProductId = $this->getFactory()->getProductFacede()->getConcreteProductsByAbstractProductId($i);
                    
            foreach ($getConcreteProductsByAbstractProductId as $eventTransfer) {
                if($eventTransfer->toArray() !== null && $eventTransfer->toArray() !== '') {
                    $concrete[] = $eventTransfer->toArray();
                }
            }
            $locale = $this->getFactory()->getLocaleFacede()->getCurrentLocale();
            $categories = $this->mixed->getProductCategories($i, $locale);
    
            $data = $this->mixed->createArrayToSend(
                'QuasirisSenderPlugin',
                $eventName,
                $abstract,
                $concrete,
                $categories,
                $i,
                $type
            );
            $this->sender->getDataFromApi($data, $this->getConfig()->getMySetting());
        }        
    }
}
