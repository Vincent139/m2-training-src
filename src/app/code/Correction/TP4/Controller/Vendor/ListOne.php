<?php
namespace Correction\TP4\Controller\Vendor;

use Correction\TP4\Controller\AbstractListOne;
use Correction\TP4\Model\VendorFactory;
use Correction\TP4\Model\ResourceModel\Vendor as VendorResource;
use Magento\Framework\App\Action\Context;

class ListOne extends AbstractListOne
{
    /**
     * Vendor\ListOne constructor.
     *
     * @param VendorFactory $modelFactory
     * @param VendorResource $resourceModel
     * @param Context $context
     */
    public function __construct(
        VendorFactory $modelFactory,
        VendorResource $resourceModel,
        Context $context
    ) {
        parent::__construct($modelFactory, $resourceModel, $context);
    }
}