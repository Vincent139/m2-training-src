<?php
namespace Correction\TP9\Helper;

use Correction\TP4\Model\Vendor;
use Correction\TP4\Model\Vendor as VendorModel;
use Correction\TP4\Model\VendorFactory;
use Correction\TP9\Api\Data\VendorInterface;
use Correction\TP9\Api\Data\VendorInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Reflection\DataObjectProcessor;

class VendorDataObjectConverter
{
    /** @var VendorInterfaceFactory */
    protected $dataObjectFactory;

    /** @var VendorFactory */
    protected $modelFactory;

    /** @var DataObjectHelper */
    protected $dataObjectHelper;

    /** @var DataObjectProcessor */
    protected $dataObjectProcessor;

    /**
     * VendorDataObjectConverter constructor.
     *
     * @param VendorInterfaceFactory $dataObjectFactory
     * @param VendorFactory $modelFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     */
    public function __construct(
        VendorInterfaceFactory $dataObjectFactory,
        VendorFactory $modelFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor
    ) {
        $this->dataObjectFactory = $dataObjectFactory;
        $this->modelFactory = $modelFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * Create a data object from a model.
     *
     * @param VendorModel $model
     * @return VendorInterface
     */
    public function getDataObjectFromModel(VendorModel $model)
    {
        $data = $model->getData();
        $dataObject = $this->dataObjectFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $dataObject,
            $data,
            VendorInterface::class
        );
        $dataObjectId = $model->getId();
        if ($dataObjectId) {
            $dataObject->setId($dataObjectId);
        }
        return $dataObject;
    }

    /**
     * Create a model from a data object.
     *
     * @param VendorInterface $dataObject
     * @return VendorModel
     */
    public function getModelFromDataObject(VendorInterface $dataObject)
    {
        /** @var Vendor $model */
        $model = $this->modelFactory->create();

        $dataObjectAttributes = $this->dataObjectProcessor->buildOutputDataArray(
            $dataObject,
            VendorInterface::class
        );

        foreach ($dataObjectAttributes as $attributeCode => $attributeData) {
            $model->setDataUsingMethod($attributeCode, $attributeData);
        }

        $modelId = $dataObject->getId();
        if ($modelId) {
            $model->setId($modelId);
        }

        return $model;
    }
}
