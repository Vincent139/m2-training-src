<?php
namespace Correction\TP4\Controller\Vendor;

use Correction\TP4\Controller\AbstractSave;
use Correction\TP4\Model\VendorFactory;
use Correction\TP4\Model\ResourceModel\Series as VendorResource;
use Magento\Framework\App\Action\Context;

class Create extends AbstractSave
{
    /** @var VendorFactory */
    protected $modelFactory;

    /**
     * Vendor\Create constructor.
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
        $this->modelFactory = $modelFactory;

        parent::__construct($resourceModel, $context);
    }

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        $name = $this->getRequest()->getParam('name');
        if (empty($name)) throw new \Exception(sprintf('Expected non empty string parameter [%s]', 'name'));

        return $this->modelFactory->create([ 'name' => $name ]);
    }
}