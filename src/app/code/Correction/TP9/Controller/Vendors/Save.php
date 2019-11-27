<?php
namespace Correction\TP9\Controller\Vendors;

use Correction\TP4\Model\Vendor as VendorModel;
use Correction\TP9\Api\VendorRepositoryInterface;
use Correction\TP9\Helper\VendorDataObjectConverter;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Correction\TP4\Model\VendorFactory;

class Save extends Action
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

        $name = $this->getRequest()->getParam('name');
        if (!$name) {
            $data[] = [
                'error' => sprintf('Expected mandatory string parameter [%s]', 'name')
            ];
        } else {
            $dataObject = [ 'name' => $name ];

            $id = $this->getRequest()->getParam('id');
            if ($id !== null && (int)$id === 0) {
                $data[] = [
                    'error' => sprintf('Expected parameter [%s] integer > 0', 'id')
                ];
            } else {
                $dataObject['id'] = $id;
                /** @var VendorModel $model */
                $model = $this->vendorFactory->create(['data' => $dataObject]);

                try {
                    $dataObject = $this->vendorRepository->save(
                        $this->dataObjectConverter->getDataObjectFromModel($model)
                    );
                    $data [] = [
                        'info' => sprintf('Data object saved with id [%d]', $dataObject->getId())
                    ];
                } catch (AlreadyExistsException $e) {
                    $data[] = [
                        'error' => sprintf('AlreadyExistsException while saving data object : %s', $e->getMessage())
                    ];
                }
            }
        }

        return $this->jsonFactory->create()->setData($data);
    }
}
