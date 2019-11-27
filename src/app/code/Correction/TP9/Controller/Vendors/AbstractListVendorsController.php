<?php
namespace Correction\TP9\Controller\Vendors;

use Correction\TP9\Api\VendorRepositoryInterface;
use Correction\TP9\Exception\BadRequestException;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

abstract class AbstractListVendorsController extends Action
{
    /** @var VendorRepositoryInterface */
    protected $vendorRepository;

    /** @var SearchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    /** @var FilterBuilder */
    protected $filterBuilder;

    /** @var FilterGroupBuilder */
    protected $filterGroupBuilder;

    /** @var JsonFactory */
    protected $jsonFactory;

    /**
     * AbstractListVendorsController constructor.
     *
     * @param VendorRepositoryInterface $vendorRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param JsonFactory $jsonFactory
     * @param Context $context
     */
    public function __construct(
        VendorRepositoryInterface $vendorRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        JsonFactory $jsonFactory,
        Context $context
    ) {
        $this->vendorRepository = $vendorRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->jsonFactory = $jsonFactory;

        parent::__construct($context);
    }

    protected function getLimit30CriteriaBudiler()
    {
        return $this->searchCriteriaBuilder->setPageSize(30)->setCurrentPage(1);
    }

    /**
     * @return SearchCriteriaBuilder
     * @throws BadRequestException
     */
    abstract protected function getCriteriaBuilder();

    public function execute()
    {
        $data = [];

        try {
            $searchCriteria = $this->getCriteriaBuilder()->create();

            $vendors = $this->vendorRepository->getList($searchCriteria);
            if ($vendors->getTotalCount() > 0) {
                foreach ($vendors->getItems() as $vendor) {
                    $data[] = [
                        'id' => $vendor->getId(),
                        'name' => $vendor->getName()
                    ];
                }
            } else {
                $data [] = [
                    'info' => sprintf('No vendor found.')
                ];
            }
        } catch (BadRequestException $e) {
            $data[] = [
                'error' => sprintf('BadRequestException : %s', $e->getMessage())
            ];
        }

        return $this->jsonFactory->create()->setData($data);
    }
}
