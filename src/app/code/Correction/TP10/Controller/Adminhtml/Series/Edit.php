<?php
namespace Correction\TP10\Controller\Adminhtml\Series;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * Array of actions which can be processed without secret key validation
     *
     * @var array
     */
    protected $_publicActions = ['edit'];

    /** @var Builder */
    protected $builder;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    public function __construct(
        Builder $builder,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->builder = $builder;
        $this->resultPageFactory = $resultPageFactory;

        parent::__construct($context);
    }

    /**
     * Series edit form
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $seriesId = (int) $this->getRequest()->getParam('id');
        $series = $this->builder->build($this->getRequest());

        if (($seriesId && !$series->getId())) {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(__('This series doesn\'t exist.'));
            return $resultRedirect->setPath('formationtp10/*/');
        } elseif ($seriesId === 0) {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(__('Invalid series id. Should be numeric value greater than 0'));
            return $resultRedirect->setPath('formationtp10/*/');
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Formation_TP10::series_edit');
        $resultPage->getConfig()->getTitle()->prepend(__('Series'));
        $resultPage->getConfig()->getTitle()->prepend($series->getName());

        return $resultPage;
    }
}
