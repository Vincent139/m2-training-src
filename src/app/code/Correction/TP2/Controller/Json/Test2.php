<?php
namespace Correction\TP2\Controller\Json;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Test2 extends Action
{
    /**
     * @return ResultInterface
     */
    public function execute()
    {
        switch ($this->getRequest()->getParam('action')) {
            case 'forward':
                return $this->resultFactory->create(ResultFactory::TYPE_FORWARD)->forward('test1');

            case 'redirect':
                return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/test1');

            default:
                return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData([ 'response' => 'test2' ]);
        }
    }
}