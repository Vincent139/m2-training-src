<?php

namespace Correction\TP10\Controller\Adminhtml\Series;

use Correction\TP4\Model\ResourceModel\Series;
use Correction\TP4\Model\ResourceModel\Vendor;
use Correction\TP4\Model\SeriesFactory;
use Correction\TP4\Model\VendorFactory;
use Correction\TP9\Api\Data\VendorInterface;
use Correction\TP9\Api\Data\VendorInterfaceFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Delete
 * @package Correction\TP10\Controller\Adminhtml\Series
 */
class Delete extends \Magento\Backend\App\Action
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
     * Delete constructor.
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
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('series_id');

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        try {
            if($id)
            {
                $seriesModel = $this->seriesFactory->create();
                $this->seriesResource->load($seriesModel, $id);
                $this->seriesResource->delete($seriesModel);

                $this->messageManager->addSuccessMessage(__('Deleted successfully.'));
                $result->setPath('*/*/');
            }
            else
            {
                throw new LocalizedException(__('No ID provided.'));
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
