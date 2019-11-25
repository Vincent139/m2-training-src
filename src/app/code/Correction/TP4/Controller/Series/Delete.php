<?php
namespace Correction\TP4\Controller\Series;

use Correction\TP4\Controller\AbstractDelete;
use Correction\TP4\Model\SeriesFactory;
use Correction\TP4\Model\ResourceModel\Series as SeriesResource;
use Magento\Framework\App\Action\Context;

class Delete extends AbstractDelete
{
    /**
     * Series\Delete constructor.
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
        parent::__construct($resourceModel, $context);

        $this->_init($modelFactory);
    }
}
