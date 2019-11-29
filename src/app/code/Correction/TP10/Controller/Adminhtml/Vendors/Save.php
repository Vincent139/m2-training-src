<?php

namespace Correction\TP10\Controller\Adminhtml\Vendors;

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
 * Edit CMS page action.
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Correction_TP10::vendors_edit';
    /**
     * @var VendorRepositoryInterface
     */
    private $vendorRepository;
    /**
     * @var VendorInterfaceFactory
     */
    private $vendorFactory;

    public function __construct(
        Action\Context $context,
        VendorRepositoryInterface $vendorRepository,
        VendorInterfaceFactory $vendorFactory
    )
    {
        parent::__construct($context);
        $this->vendorRepository = $vendorRepository;
        $this->vendorFactory = $vendorFactory;
    }

    /**
     * Edit CMS page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('vendor_id');
        $name = $this->getRequest()->getParam('name');

        /** @var VendorInterface $vendorDTO */
        $vendorDTO = $this->vendorFactory->create();
        $vendorDTO->setId($id);
        $vendorDTO->setName($name);

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        try {
            $vendorDTO = $this->vendorRepository->save($vendorDTO);
            $back = $this->getRequest()->getParam('back');

            $this->messageManager->addSuccessMessage(__('Saved successfully.'));
            if($back == 'edit')
            {
                $result->setPath('*/*/edit', ['vendor_id' => $vendorDTO->getId()]);
            }
            else
            {
                $result->setPath('*/*/');
            }
        }
        catch(LocalizedException $e)
        {
            $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e, __('Something went wrong: %1', $e->getMessage()));
            $result->setPath('*/*/edit', ['vendor_id' => $id]);
        }
        catch(\Exception $e)
        {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong: %1', $e->getMessage()));
            $result->setPath('*/*/edit', ['vendor_id' => $id]);
        }

        return $result;
    }
}
