<?php
namespace Correction\TP4\Controller\Vendor;

use Correction\TP4\Controller\AbstractSave;
use Correction\TP4\Exception\BadRequestException;
use Correction\TP4\Model\Vendor;
use Correction\TP4\Model\VendorFactory;
use Correction\TP4\Model\ResourceModel\Vendor as VendorResource;
use Magento\Framework\App\Action\Context;

class Update extends AbstractSave
{
    /** @var VendorFactory */
    protected $modelFactory;

    /**
     * Vendor\Update constructor.
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

    public function getModel()
    {
        $id = (int)$this->getRequest()->getParam('id');

        if ($id != 0) {

            /** @var Vendor $model */
            $model = $this->modelFactory->create();
            $this->resourceModel->load($model, $id);

            if (!$model->getId()) {
                throw new BadRequestException(sprintf('Model not found with id [%d]', $id));
            }

            $name = $this->getRequest()->getParam('name');
            if (!empty($name)) {
                $model->setName($name);
            }
            $products = $this->getRequest()->getParam('products');
            if (!empty($products)) {
                $productIds = explode(',', $products);
                foreach ($productIds as $productId) {
                    if ((int)$productId == 0) {
                        throw new BadRequestException(
                            sprintf('Parameter [%s] must be a list of integer > 0 separated with comma', 'product')
                        );
                    }
                }
                $model->setProductIds($productIds);
            }

            return $model;
        } else {
            throw new BadRequestException(sprintf('Require parameter [%s] integer > 0', 'id'));
        }
    }
}
