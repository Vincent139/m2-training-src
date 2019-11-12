<?php
namespace Correction\TP4\Controller\Series;

use Correction\TP4\Controller\AbstractSave;
use Correction\TP4\Exception\BadRequestException;
use Correction\TP4\Model\Series;
use Correction\TP4\Model\SeriesFactory;
use Correction\TP4\Model\ResourceModel\Series as SeriesResource;
use Magento\Framework\App\Action\Context;

class Update extends AbstractSave
{
    /** @var SeriesFactory */
    protected $modelFactory;

    /**
     * Series\Update constructor.
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

    public function getModel()
    {
        $id = (int)$this->getRequest()->getParam('id');

        if ($id != 0) {

            /** @var Series $model */
            $model = $this->modelFactory->create();
            $this->resourceModel->load($model, $id);

            if (!$model->getId()) {
                throw new BadRequestException(sprintf('Model not found with id [%d]', $id));
            }

            $name = $this->getRequest()->getParam('name');
            if (!empty($name)) {
                $model->setName($name);
            }
            $color = $this->getRequest()->getParam('color');
            if (!empty($color)) {
                $model->setColor($color);
            }

            return $model;
        } else {
            throw new BadRequestException(sprintf('Require parameter [%s] integer > 0', 'id'));
        }
    }
}
