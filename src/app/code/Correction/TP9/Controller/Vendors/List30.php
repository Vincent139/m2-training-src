<?php
namespace Correction\TP9\Controller\Vendors;

class List30 extends AbstractListVendorsController
{
    protected function getCriteriaBuilder()
    {
        return $this->getLimit30CriteriaBudiler();
    }
}
