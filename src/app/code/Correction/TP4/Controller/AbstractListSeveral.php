<?php
namespace Correction\TP4\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Model\AbstractModel;

class AbstractListSeveral extends Action
{
    protected $collectionFactory;

    protected function _init($collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $data = [];

        $collection = $this->collectionFactory->create();
        if ($collection->getSize()) {
            /** @var AbstractModel $model */
            foreach ($collection as $model) {
                $data[] = $model->getData();
            }
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($data);
    }
}
