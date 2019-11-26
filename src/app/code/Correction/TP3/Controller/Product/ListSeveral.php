<?php
namespace Correction\TP3\Controller\Product;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Data\Collection;

class ListSeveral extends Action
{
    /** @var CollectionFactory */
    protected $collectionFactory;

    /**
     * ListSeveral constructor.
     *
     * @param CollectionFactory $collectionFactory
     * @param Context $context
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context
    ) {
        $this->collectionFactory = $collectionFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $data = [];

        if (($type = $this->getRequest()->getParam('type'))) {
            $collection = $this->collectionFactory->create();
            $collection
                ->addAttributeToFilter('type_id', $type)
                ->addAttributeToSelect('name');
            $sort = $this->getRequest()->getParam('sort');
            if ($sort) {
                if (($order = $this->getRequest()->getParam('order')) && in_array($order, [ 'asc', 'desc' ])) {
                    $order = ($order == 'asc') ? Collection::SORT_ORDER_ASC : Collection::SORT_ORDER_DESC;
                    if (in_array(
                        $sort,
                        [
                            'entity_id',
                            'attribute_set_id',
                            'type_id',
                            'sku',
                            'has_options',
                            'required_options',
                            'created_at',
                            'updated_at'
                        ]
                    )) {
                        $collection->addOrder($sort, $order);
                    } else {
                        $collection->addAttributeToSort($sort, $order);
                    }

                } else {
                    $data[] = [
                        'error' => sprintf('Require parameter [%s] with value among [%s]', 'order', 'asc, desc')
                    ];
                }
            }
            if (($page = $this->getRequest()->getParam('page')) || ($size = $this->getRequest()->getParam('size'))) {
                if ((int)$page !== 0) {
                    if (($size = (int)$this->getRequest()->getParam('size')) !== 0) {
                        $collection->setPage($page, $size);
                    } else {
                        $data[] = [
                            'error' => sprintf('Require parameter [%s] integer > 0', 'size')
                        ];
                    }
                } else {
                    $data[] = [
                        'error' => sprintf('Parameter [%s] must be integer > 0', 'page')
                    ];
                }
            }
            if ($collection->getSize()) {
                /** @var Product $product */
                foreach ($collection as $product) {
                    $data[] = [
                        'name' => $product->getName(),
                        'sku' => $product->getSku()
                    ];
                }
            } else {
                $data[] = [
                    'info' => sprintf('No product found with type [%s]', $type)
                ];
            }
        } else {
            $data[] = [
                'error' => sprintf('Require parameter [%s]', 'type')
            ];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($data);
    }
}
