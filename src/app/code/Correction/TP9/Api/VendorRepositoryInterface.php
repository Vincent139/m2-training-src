<?php
namespace Correction\TP9\Api;

use Correction\TP9\Api\Data\VendorInterface;
use Correction\TP9\Api\Data\VendorSearchResultsInterface;
use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @api
 */
interface VendorRepositoryInterface
{
    /**
     * Save a vendor
     *
     * @param VendorInterface $dataObject
     * @return VendorInterface
     * @throws AlreadyExistsException
     */
    public function save(VendorInterface $dataObject);

    /**
     * Get a vendor by its id
     *
     * @param int $id
     * @return VendorInterface
     * @throws NoSuchEntityException
     */
    public function get($id);

    /**
     * Get a list of vendor(s)
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return VendorSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Get a list of product ids associated with a vendor.
     *
     * @param int $id
     * @return array
     * @throws NoSuchEntityException
     */
    public function getAssociatedProductIds($id);
}
