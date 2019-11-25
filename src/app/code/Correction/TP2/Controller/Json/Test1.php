<?php
namespace Correction\TP2\Controller\Json;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Test1 extends Action
{
    /** @var JsonFactory */
    protected $jsonFactory;

    public function __construct(
        JsonFactory $jsonFactory,
        Context $context
    ) {
        $this->jsonFactory = $jsonFactory;

        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Json $result */
        $result = $this->jsonFactory->create();

        $data = [
            'response' => 'test1',
            'params' => $this->getRequest()->getParams()
        ];

        $result->setData($data);

        return $result;
    }
}