<?php
namespace Correction\TP9\Controller\Products;

use Correction\TP9\Exception\BadRequestException;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

abstract class AbstractListProductsController extends Action
{
    /** @var ProductRepositoryInterface */
    protected $productRepository;

    /** @var SearchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    /** @var FilterBuilder */
    protected $filterBuilder;

    /** @var FilterGroupBuilder */
    protected $filterGroupBuilder;

    /** @var JsonFactory */
    protected $jsonFactory;

    /**
     * AbstractListProductsController constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param JsonFactory $jsonFactory
     * @param Context $context
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        JsonFactory $jsonFactory,
        Context $context
    ) {
        $this->productRepository = $productRepository;
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

            $products = $this->productRepository->getList($searchCriteria);
            if ($products->getTotalCount() > 0) {
                foreach ($products->getItems() as $product) {
                    $data[] = [
                        'id' => $product->getId(),
                        'sku' => $product->getSku(),
                        'name' => $product->getName()
                    ];
                }
            } else {
                $data [] = [
                    'info' => sprintf('No product found.')
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
