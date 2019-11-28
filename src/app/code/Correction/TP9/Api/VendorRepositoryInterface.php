<?php
namespace Correction\TP9\Api;

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
     * @param \Correction\TP9\Api\Data\VendorInterface $dataObject
     * @return \Correction\TP9\Api\Data\VendorInterface
     * @throws AlreadyExistsException
     */
    public function save(\Correction\TP9\Api\Data\VendorInterface $dataObject);

    /**
     * Get a vendor by its id
     *
     * @param int $id
     * @return \Correction\TP9\Api\Data\VendorInterface
     * @throws NoSuchEntityException
     */
    public function get($id);

    /**
     * Delete a vendor by its id
     *
     * @param int $id
     * @return void
     * @throws NoSuchEntityException
     */
    public function delete($id);

    /**
     * Get a list of vendor(s)
     *
     * @param \Magento\Framework\Api\Search\SearchCriteriaInterface $searchCriteria
     * @return \Correction\TP9\Api\Data\VendorSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\Search\SearchCriteriaInterface $searchCriteria);

    /**
     * Get a list of product ids associated with a vendor.
     *
     * @param int $id
     * @return int[]
     * @throws NoSuchEntityException
     */
    public function getAssociatedProductIds($id);
}
