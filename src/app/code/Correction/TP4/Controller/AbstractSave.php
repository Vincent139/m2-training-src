<?php
namespace Correction\TP4\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

abstract class AbstractSave extends Action
{
    /** @var AbstractDb */
    protected $resourceModel;

    /**
     * AbstractSave constructor.
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

    /**
     * Get an instance of model with data to be saved.
     *
     * @return AbstractModel
     * @throws \Exception
     */
    abstract public function getModel();

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function execute()
    {
        $data = [];
        $model = null;
        $error = false;

        try {
            $model = $this->getModel();
        } catch (\Exception $e) {
            $error = true;
            $data[] = [
                'error' => sprintf('Exception while creating model instance : %s', $e->getMessage())
            ];
        }

        if (!$error) {
            try {
                $this->resourceModel->save($model);
                $data [] = [
                    'info' => sprintf('Model saved with id [%d]', $model->getId())
                ];
            } catch (AlreadyExistsException $e) {
                $data[] = [
                    'error' => sprintf('AlreadyExistsException while saving model : %s', $e->getMessage())
                ];
            }
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($data);
    }
}
