<?php
namespace Correction\TP4\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

abstract class AbstractListOne extends Action
{
    protected $modelFactory;

    /** @var AbstractDb */
    protected $resourceModel;

    /**
     * AbstractListOne constructor.
     *
     * @param $modelFactory
     * @param AbstractDb $resourceModel
     * @param Context $context
     */
    public function __construct(
        $modelFactory,
        AbstractDb $resourceModel,
        Context $context
    ) {
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;

        parent::__construct($context);
    }

    public function execute()
    {
        $data = [];

        $id = intval($this->getRequest()->getParam('id'));

        if ($id !== 0) {
            /** @var AbstractModel $model */
            $model = $this->modelFactory->create();
            $this->resourceModel->load($model, $id);
            if ($model->getId()) {
                $data = $model->getData();
            } else {
                $data[] = [
                    'info' => sprintf('Model [%s] not found with id [%d]', $model->getResourceName(), $id)
                ];
            }
        } else {
            $data[] = [
                'error' => sprintf('Require parameter [%s] integer > 0', 'id')
            ];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($data);
    }
}