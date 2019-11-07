<?php
namespace Correction\TP2\Controller\Json;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Test1 extends Action
{
    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Json $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        $data = [
            'response' => 'test1',
            'params' => $this->getRequest()->getParams()
        ];

        $result->setData($data);

        return $result;
    }
}