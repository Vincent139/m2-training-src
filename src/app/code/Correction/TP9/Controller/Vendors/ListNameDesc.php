<?php
namespace Correction\TP9\Controller\Vendors;

use Magento\Framework\Api\SortOrder;

class ListNameDesc extends AbstractListVendorsController
{
    protected function getCriteriaBuilder()
    {
        return $this->getLimit30CriteriaBudiler()->addSortOrder('name', SortOrder::SORT_DESC);
    }
}
