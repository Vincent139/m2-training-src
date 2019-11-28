<?php
namespace Correction\TP9\Model;

use Correction\TP9\Api\Data\SeriesInterface;
use Correction\TP9\Api\Data\SeriesSearchResultsInterface;
use Correction\TP9\Api\Data\SeriesSearchResultsInterfaceFactory;
use Correction\TP9\Api\SeriesRepositoryInterface;

use Correction\TP9\Helper\VendorDataObjectConverter;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;

use Correction\TP4\Model\SeriesFactory;
use Correction\TP4\Model\Series as SeriesModel;
use Correction\TP4\Model\ResourceModel\Series as SeriesResourceModel;
use Correction\TP4\Model\ResourceModel\Series\CollectionFactory as SeriesCollectionFactory;
use Correction\TP4\Model\ResourceModel\Series\Collection as SeriesCollection;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class SeriesRepository implements SeriesRepositoryInterface
{
    /** @var SeriesFactory */
    protected $modelFactory;

    /** @var SeriesSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    /** @var SearchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    /** @var FilterBuilder */
    protected $filterBuilder;

    /** @var SeriesCollectionFactory */
    protected $collectionFactory;

    /** @var SeriesResourceModel */
    protected $resourceModel;

    /** @var DataObjectHelper */
    protected $dataObjectConverterHelper;

    /** @var CollectionProcessorInterface */
    protected $collectionProcessor;

    /**
     * VendorRepository constructor.
     *
     * @param SeriesFactory $modelFactory
     * @param SeriesSearchResultsInterfaceFactory $searchResultsFactory
     * @param SeriesCollectionFactory $collectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SeriesResourceModel $resourceModel
     * @param FilterBuilder $filterBuilder
     * @param SeriesDataObjectConverter $dataObjectConverterHelper
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        SeriesFactory $modelFactory,
        SeriesSearchResultsInterfaceFactory $searchResultsFactory,
        SeriesCollectionFactory $collectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SeriesResourceModel $resourceModel,
        FilterBuilder $filterBuilder,
        SeriesDataObjectConverter $dataObjectConverterHelper,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->modelFactory = $modelFactory;
        $this->collectionFactory = $collectionFactory;
        $this->resourceModel = $resourceModel;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectConverterHelper = $dataObjectConverterHelper;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(SeriesInterface $dataObject)
    {
        $model = $this->dataObjectConverterHelper->getModelFromDataObject($dataObject);
        $this->resourceModel->save($model);

        // the model may have been updated after save (typically with its id if it's never been saved until now),
        // thus we re instantiate a new data object rather than returning the original
        return $this->dataObjectConverterHelper->getDataObjectFromModel($model);
    }

    /**
     * @inheritDoc
     */
    public function get($id)
    {
        /** @var SeriesModel $model */
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model, $id);

        if (!$model->getId()) {
            throw new NoSuchEntityException();
        }

        return $this->dataObjectConverterHelper->getDataObjectFromModel($model);
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function delete($id)
    {
        $dataObject = $this->get($id);
        $this->resourceModel->delete($this->dataObjectConverterHelper->getModelFromDataObject($dataObject));
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var SeriesCollection $collection */
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var SeriesSearchResultsInterface $searchResult */
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }
}
