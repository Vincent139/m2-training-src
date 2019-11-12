<?php
namespace Correction\TP4\Controller\Vendor;

use Correction\TP4\Controller\AbstractListSeveral;
use Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Framework\App\Action\Context;

class ListSeveral extends AbstractListSeveral
{
    /**
     * Vendor\ListSeveral constructor.
     *
     * @param CollectionFactory $collectionFactory
     * @param Context $context
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context
    ) {
        parent::__construct($collectionFactory, $context);
    }
}
