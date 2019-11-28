<?php
namespace Correction\TP9\Api\Data;

/**
 * @api
 */
interface SeriesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get series list.
     *
     * @return \Correction\TP9\Api\Data\SeriesInterface[]
     */
    public function getItems();

    /**
     * Set series list.
     *
     * @param \Correction\TP9\Api\Data\SeriesInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
