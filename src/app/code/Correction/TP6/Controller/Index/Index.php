<?php
namespace Correction\TP6\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /** @var PageFactory */
    protected $pageFactory;

    /**
     * Index constructor.
     * @param PageFactory $pageFactory
     * @param Context $context
     */
    public function __construct(
        PageFactory $pageFactory,
        Context $context
    ) {
        $this->pageFactory = $pageFactory;

        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create();

        return $resultPage;
    }
}
