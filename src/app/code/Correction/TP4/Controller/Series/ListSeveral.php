<?php
namespace Correction\TP4\Controller\Series;

use Correction\TP4\Controller\AbstractListSeveral;
use Correction\TP4\Model\ResourceModel\Series\CollectionFactory;
use Magento\Framework\App\Action\Context;

class ListSeveral extends AbstractListSeveral
{
    /**
     * Series\ListSeveral constructor.
     *
     * @param CollectionFactory $collectionFactory
     * @param Context $context
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context
    ) {
        parent::__construct($context);

        $this->_init($collectionFactory);
    }
}
