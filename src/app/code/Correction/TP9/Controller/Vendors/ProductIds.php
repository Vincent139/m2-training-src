<?php
namespace Correction\TP9\Controller\Vendors;

use Correction\TP9\Api\VendorRepositoryInterface;
use Correction\TP9\Helper\VendorDataObjectConverter;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Correction\TP4\Model\VendorFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class ProductIds extends Action
{
    /** @var VendorRepositoryInterface */
    protected $vendorRepository;

    /** @var VendorFactory */
    protected $vendorFactory;

    /** @var VendorDataObjectConverter */
    protected $dataObjectConverter;

    /** @var JsonFactory */
    protected $jsonFactory;

    /**
     * Save constructor.
     *
     * @param VendorRepositoryInterface $vendorRepository
     * @param VendorFactory $vendorFactory
     * @param VendorDataObjectConverter $dataObjectConverter
     * @param JsonFactory $jsonFactory
     * @param Context $context
     */
    public function __construct(
        VendorRepositoryInterface $vendorRepository,
        VendorFactory $vendorFactory,
        VendorDataObjectConverter $dataObjectConverter,
        JsonFactory $jsonFactory,
        Context $context
    ) {
        $this->vendorRepository = $vendorRepository;
        $this->vendorFactory = $vendorFactory;
        $this->dataObjectConverter = $dataObjectConverter;
        $this->jsonFactory = $jsonFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $data = [];

        $id = (int)$this->getRequest()->getParam('id');
        if ($id === 0) {
            $data[] = [
                'error' => sprintf('Require parameter [%s] integer > 0', 'id')
            ];
        } else {
            try {
                $productIds = $this->vendorRepository->getAssociatedProductIds($id);
                $data [] = $productIds;
            } catch (NoSuchEntityException $e) {
                $data[] = [
                    'error' => sprintf('NoSuchEntityException while loading data object : %s', $e->getMessage())
                ];
            }
        }

        return $this->jsonFactory->create()->setData($data);
    }
}
