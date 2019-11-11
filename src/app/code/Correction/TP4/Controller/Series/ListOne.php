<?php
namespace Correction\TP4\Controller\Series;

use Correction\TP4\Controller\AbstractListOne;
use Correction\TP4\Model\SeriesFactory;
use Correction\TP4\Model\ResourceModel\Series as SeriesResource;
use Magento\Framework\App\Action\Context;

class ListOne extends AbstractListOne
{
    /**
     * Series\ListOne constructor.
     *
     * @param SeriesFactory $modelFactory
     * @param SeriesResource $resourceModel
     * @param Context $context
     */
    public function __construct(
        SeriesFactory $modelFactory,
        SeriesResource $resourceModel,
        Context $context
    ) {
        parent::__construct($modelFactory, $resourceModel, $context);
    }
}