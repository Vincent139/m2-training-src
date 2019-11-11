<?php
namespace Correction\TP4\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

abstract class AbstractDelete extends Action
{
    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function execute()
    {
        $data = [];

        $data = [ 'info' => 'TODO' ];

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($data);
    }
}