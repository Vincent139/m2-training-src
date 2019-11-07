<?php
namespace Correction\TP3\Controller\Product;

use Magento\Catalog\Api\Data\ProductInterfaceFactory;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class ListOne extends Action
{
    /** @var ProductInterfaceFactory */
    protected $productFactory;

    /**
     * ListOne constructor.
     *
     * @param ProductInterfaceFactory $productFactory
     * @param Context $context
     */
    public function __construct(
        ProductInterfaceFactory $productFactory,
        Context $context
    ) {
        $this->productFactory = $productFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $data = [];

        $id = intval($this->getRequest()->getParam('id'));

        if ($id !== 0) {
            /** @var $product Product */
            $product = $this->productFactory->create();
            $product->load($id);
            if ($product->getId()) {
                $data[] = [
                    'name' => $product->getName(),
                    'type' => $product->getTypeId(),
                    'sku' => $product->getSku()
                ];
            } else {
                $data[] = [
                    'info' => sprintf('Product not found with id [%d]', $id)
                ];
            }
        } else {
            $data[] = [
                'error' => sprintf('Require parameter [%s] integer > 0', 'id')
            ];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($data);
    }
}