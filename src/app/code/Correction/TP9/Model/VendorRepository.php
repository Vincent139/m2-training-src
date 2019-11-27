<?php
namespace Correction\TP9\Model;

use Correction\TP9\Api\Data\VendorInterface;
use Correction\TP9\Api\Data\VendorSearchResultsInterface;
use Correction\TP9\Api\Data\VendorSearchResultsInterfaceFactory;
use Correction\TP9\Api\VendorRepositoryInterface;

use Correction\TP9\Helper\VendorDataObjectConverter;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;

use Correction\TP4\Model\VendorFactory;
use Correction\TP4\Model\Vendor as VendorModel;
use Correction\TP4\Model\ResourceModel\Vendor as VendorResourceModel;
use Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use Correction\TP4\Model\ResourceModel\Vendor\Collection as VendorCollection;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class VendorRepository implements VendorRepositoryInterface
{
    /** @var VendorFactory */
    protected $modelFactory;

    /** @var VendorSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    /** @var SearchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    /** @var FilterBuilder */
    protected $filterBuilder;

    /** @var VendorCollectionFactory */
    protected $collectionFactory;

    /** @var VendorResourceModel */
    protected $resourceModel;

    /** @var DataObjectHelper */
    protected $dataObjectConverterHelper;

    /** @var CollectionProcessorInterface */
    protected $collectionProcessor;

    /**
     * VendorRepository constructor.
     *
     * @param VendorFactory $modelFactory
     * @param VendorSearchResultsInterfaceFactory $searchResultsFactory
     * @param VendorCollectionFactory $collectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param VendorResourceModel $resourceModel
     * @param FilterBuilder $filterBuilder
     * @param VendorDataObjectConverter $dataObjectConverterHelper
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        VendorFactory $modelFactory,
        VendorSearchResultsInterfaceFactory $searchResultsFactory,
        VendorCollectionFactory $collectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        VendorResourceModel $resourceModel,
        FilterBuilder $filterBuilder,
        VendorDataObjectConverter $dataObjectConverterHelper,
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
    public function save(VendorInterface $dataObject)
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
        /** @var VendorModel $model */
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model, $id);

        return $this->dataObjectConverterHelper->getDataObjectFromModel($model);
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var VendorCollection $collection */
        $collection = $this->collectionFactory->create();

        /** @var VendorSearchResultsInterface $searchResult */
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);

        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }
}
