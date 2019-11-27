<?php
namespace Correction\TP9\Controller\Vendors;

use Correction\TP9\Exception\BadRequestException;

class ListFilter extends AbstractListVendorsController
{
    protected function getCriteriaBuilder()
    {
        $name = $this->getRequest()->getParam('name');
        if (!$name) {
            throw new BadRequestException(sprintf('Expected mandatory string parameter [%s]', 'name'));
        }

        return $this->getLimit30CriteriaBudiler()
            ->addFilter(
                $this->filterBuilder
                    ->setField('name')
                    ->setConditionType('eq')
                    ->setValue($name)
                    ->create()
            );
    }
}
