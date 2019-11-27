<?php
namespace Correction\TP9\Controller\Vendors;

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
            $model = $this->vendorFactory->create([ 'data' => [ 'name' => $name ]]);

            try {
                $dataObject = $this->vendorRepository->save($this->dataObjectConverter->getDataObjectFromModel($model));
                $data [] = [
                    'info' => sprintf('Model saved with id [%d]', $dataObject->getId())
                ];
            } catch (AlreadyExistsException $e) {
                $data[] = [
                    'error' => sprintf('AlreadyExistsException while saving model : %s', $e->getMessage())
                ];
            }
        }

        return $this->jsonFactory->create()->setData($data);
    }
}
