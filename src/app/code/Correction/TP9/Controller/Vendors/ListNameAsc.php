<?php
namespace Correction\TP9\Controller\Vendors;

use Magento\Framework\Api\SortOrder;

class ListNameAsc extends AbstractListVendorsController
{
    protected function getCriteriaBuilder()
    {
        return $this->getLimit30CriteriaBudiler()->addSortOrder('name', SortOrder::SORT_ASC);
    }
}
