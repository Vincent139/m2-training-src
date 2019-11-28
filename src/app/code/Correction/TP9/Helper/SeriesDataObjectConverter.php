<?php
namespace Correction\TP9\Helper;

use Correction\TP4\Model\Series;
use Correction\TP4\Model\Series as SeriesModel;
use Correction\TP4\Model\SeriesFactory;
use Correction\TP9\Api\Data\SeriesInterface;
use Correction\TP9\Api\Data\SeriesInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Reflection\DataObjectProcessor;

class SeriesDataObjectConverter
{
    /** @var SeriesInterfaceFactory */
    protected $dataObjectFactory;

    /** @var SeriesFactory */
    protected $modelFactory;

    /** @var DataObjectHelper */
    protected $dataObjectHelper;

    /** @var DataObjectProcessor */
    protected $dataObjectProcessor;

    /**
     * SeriesDataObjectConverter constructor.
     *
     * @param SeriesInterfaceFactory $dataObjectFactory
     * @param SeriesFactory $modelFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     */
    public function __construct(
        SeriesInterfaceFactory $dataObjectFactory,
        SeriesFactory $modelFactory,
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
     * @param SeriesModel $model
     * @return SeriesInterface
     */
    public function getDataObjectFromModel(SeriesModel $model)
    {
        $data = $model->getData();
        $dataObject = $this->dataObjectFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $dataObject,
            $data,
            SeriesInterface::class
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
     * @param SeriesInterface $dataObject
     * @return SeriesModel
     */
    public function getModelFromDataObject(SeriesInterface $dataObject)
    {
        /** @var Series $model */
        $model = $this->modelFactory->create();

        $dataObjectAttributes = $this->dataObjectProcessor->buildOutputDataArray(
            $dataObject,
            SeriesInterface::class
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
