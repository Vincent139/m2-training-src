<?php
namespace Correction\TP4\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

abstract class AbstractDelete extends Action
{
    /** @var AbstractDb */
    protected $resourceModel;

    protected $modelFactory;

    /**
     * AbstractDelete constructor.
     *
     * @param AbstractDb $resourceModel
     * @param Context $context
     */
    public function __construct(
        AbstractDb $resourceModel,
        Context $context
    ) {
        $this->resourceModel = $resourceModel;

        parent::__construct($context);
    }

    protected function _init($modelFactory)
    {
        $this->modelFactory = $modelFactory;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function execute()
    {
        $data = [];

        $id = (int)$this->getRequest()->getParam('id');

        if ($id != 0) {

            /** @var AbstractModel $model */
            $model = $this->modelFactory->create();
            $this->resourceModel->load($model, $id);

            if (!$model->getId()) {
                $data[] = [
                    'error' => sprintf('Model not found with id [%d]', $id)
                ];
            } else {
                $this->resourceModel->delete($model);
                $data [] = [
                    'info' => sprintf('Model deleted with id [%d]', $model->getId())
                ];
            }
        } else {
            $data[] = [
                sprintf('Require parameter [%s] integer > 0', 'id')
            ];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($data);
    }
}
