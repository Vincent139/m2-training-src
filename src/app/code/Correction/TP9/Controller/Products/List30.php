<?php
namespace Correction\TP9\Controller\Products;

class List30 extends AbstractListProductsController
{
    protected function getCriteriaBuilder()
    {
        return $this->getLimit30CriteriaBudiler();
    }
}