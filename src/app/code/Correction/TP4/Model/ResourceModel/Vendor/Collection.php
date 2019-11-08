<?php
namespace Correction\TP4\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Correction\TP4\Model\ResourceModel\Vendor as VendorResourceModel;
use Correction\TP4\Model\Vendor as VendorModel;

class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Vendor::class, VendorResourceModel::class);
    }
}