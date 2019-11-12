<?php
namespace Correction\TP4\Controller\Series;

use Correction\TP4\Controller\AbstractSave;
use Correction\TP4\Model\SeriesFactory;
use Correction\TP4\Model\ResourceModel\Series as SeriesResource;
use Magento\Framework\App\Action\Context;

class Create extends AbstractSave
{
    /** @var SeriesFactory */
    protected $modelFactory;

    /**
     * Series\Create constructor.
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
        $this->modelFactory = $modelFactory;

        parent::__construct($resourceModel, $context);
    }

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        $name = $this->getRequest()->getParam('name');
        if (empty($name)) throw new \Exception(sprintf('Expected non empty string parameter [%s]', 'name'));
        $color = $this->getRequest()->getParam('color');
        if (empty($color)) throw new \Exception(sprintf('Expected non empty string parameter [%s]', 'color'));

        return $this->modelFactory->create([ 'data' => [ 'name' => $name, 'color' => $color ]])->setDataChanges(true);
    }
}