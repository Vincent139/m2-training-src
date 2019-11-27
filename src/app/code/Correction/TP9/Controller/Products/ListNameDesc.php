<?php
namespace Correction\TP9\Controller\Products;

use Magento\Framework\Api\SortOrder;

class ListNameDesc extends AbstractListProductsController
{
    protected function getCriteriaBuilder()
    {
        return $this->getLimit30CriteriaBudiler()->addSortOrder('name', SortOrder::SORT_DESC);
    }
}
