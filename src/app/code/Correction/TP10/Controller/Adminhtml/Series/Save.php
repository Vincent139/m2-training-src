<?php

namespace Correction\TP10\Controller\Adminhtml\Series;

use Correction\TP4\Model\ResourceModel\Series;
use Correction\TP4\Model\SeriesFactory;
use Correction\TP9\Api\Data\VendorInterface;
use Correction\TP9\Api\Data\VendorInterfaceFactory;
use Correction\TP9\Api\VendorRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package Correction\TP10\Controller\Adminhtml\Series
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Correction_TP10::series_edit';
    /**
     * @var SeriesFactory
     */
    protected $seriesFactory;
    /**
     * @var Series
     */
    protected $seriesResource;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param Series $seriesResource
     * @param SeriesFactory $seriesFactory
     */
    public function __construct(
        Action\Context $context,
        Series $seriesResource,
        SeriesFactory $seriesFactory
    )
    {
        parent::__construct($context);
        $this->seriesResource = $seriesResource;
        $this->seriesFactory = $seriesFactory;
    }

    /**
     * Edit CMS page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('series_id');
        $name = $this->getRequest()->getParam('name');
        $color = $this->getRequest()->getParam('color');

        $seriesModel = $this->seriesFactory->create();
        if($id)
        {
            $this->seriesResource->load($seriesModel, $id);
        }
        $seriesModel->addData([
            'name' => $name, 'color' => $color
        ]);

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        try {
            $this->seriesResource->save($seriesModel);
            $back = $this->getRequest()->getParam('back');

            $this->messageManager->addSuccessMessage(__('Saved successfully.'));
            if($back == 'edit')
            {
                $result->setPath('*/*/edit', ['series_id' => $seriesModel->getId()]);
            }
            else
            {
                $result->setPath('*/*/');
            }
        }
        catch(LocalizedException $e)
        {
            $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e, __('Something went wrong: %1', $e->getMessage()));
            $result->setPath('*/*/edit', ['series_id' => $id]);
        }
        catch(\Exception $e)
        {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong: %1', $e->getMessage()));
            $result->setPath('*/*/edit', ['series_id' => $id]);
        }

        return $result;
    }
}
