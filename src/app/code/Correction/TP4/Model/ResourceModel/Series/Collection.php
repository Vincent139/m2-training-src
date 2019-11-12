<?php
namespace Correction\TP4\Model\ResourceModel\Series;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Correction\TP4\Model\ResourceModel\Series as SeriesResourceModel;
use Correction\TP4\Model\Series as SeriesModel;

class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(SeriesModel::class, SeriesResourceModel::class);
    }
}
