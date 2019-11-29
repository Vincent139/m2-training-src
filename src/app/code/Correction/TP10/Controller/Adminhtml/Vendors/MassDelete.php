<?php

namespace Correction\TP10\Controller\Adminhtml\Vendors;

use Correction\TP4\Model\ResourceModel\Vendor;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;


use Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Massactions filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var Vendor
     */
    protected $vendorResource;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        Vendor $vendorResource
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->vendorResource = $vendorResource;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $seriesDeleted = 0;
        foreach ($collection->getItems() as $vendor) {
            $this->vendorResource->delete($vendor);
            $seriesDeleted++;
        }

        if ($seriesDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $seriesDeleted)
            );
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('correctiontp10/vendors/index');
    }
}
