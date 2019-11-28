<?php
namespace Correction\TP9\Api;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @api
 */
interface SeriesRepositoryInterface
{
    /**
     * Save a series
     *
     * @param \Correction\TP9\Api\Data\SeriesInterface $dataObject
     * @return \Correction\TP9\Api\Data\SeriesInterface
     * @throws AlreadyExistsException
     */
    public function save(\Correction\TP9\Api\Data\SeriesInterface $dataObject);

    /**
     * Get a series by its id
     *
     * @param int $id
     * @return \Correction\TP9\Api\Data\SeriesInterface
     * @throws NoSuchEntityException
     */
    public function get($id);

    /**
     * Delete a series by its id
     *
     * @param int $id
     * @return void
     * @throws NoSuchEntityException
     */
    public function delete($id);

    /**
     * Get a list of series
     *
     * @param \Magento\Framework\Api\Search\SearchCriteriaInterface $searchCriteria
     * @return \Correction\TP9\Api\Data\SeriesSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\Search\SearchCriteriaInterface $searchCriteria);
}
