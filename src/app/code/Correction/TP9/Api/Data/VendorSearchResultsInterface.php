<?php
namespace Correction\TP9\Api\Data;

/**
 * @api
 */
interface VendorSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get vendors list.
     *
     * @return \Correction\TP9\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * Set vendors list.
     *
     * @param \Correction\TP9\Api\Data\VendorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
