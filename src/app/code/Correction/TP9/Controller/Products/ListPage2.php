<?php
namespace Correction\TP9\Controller\Products;

class ListPage2 extends AbstractListProductsController
{
    protected function getCriteriaBuilder()
    {
        return $this->getLimit30CriteriaBudiler()->setCurrentPage(2);
    }
}
