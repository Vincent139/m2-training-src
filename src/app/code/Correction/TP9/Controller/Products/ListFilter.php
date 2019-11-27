<?php
namespace Correction\TP9\Controller\Products;

use Correction\TP9\Exception\BadRequestException;

class ListFilter extends AbstractListProductsController
{
    protected function getCriteriaBuilder()
    {
        $type = $this->getRequest()->getParam('type');
        if (!$type) {
            throw new BadRequestException(sprintf('Expected mandatory string parameter [%s]', 'type'));
        }
        $name = $this->getRequest()->getParam('name');
        if (!$name) {
            throw new BadRequestException(sprintf('Expected mandatory string parameter [%s]', 'name'));
        }

        return $this->getLimit30CriteriaBudiler()
            ->addFilter(
                $this->filterBuilder
                    ->setField('type_id')
                    ->setConditionType('eq')
                    ->setValue($type)
                    ->create()
            )
            ->addFilter(
                $this->filterBuilder
                    ->setField('name')
                    ->setConditionType('eq')
                    ->setValue($name)
                    ->create()
            );
    }
}
