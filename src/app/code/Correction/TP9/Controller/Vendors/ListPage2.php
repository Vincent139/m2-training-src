<?php
namespace Correction\TP9\Controller\Vendors;

class ListPage2 extends AbstractListVendorsController
{
    protected function getCriteriaBuilder()
    {
        return $this->getLimit30CriteriaBudiler()->setCurrentPage(2);
    }
}
