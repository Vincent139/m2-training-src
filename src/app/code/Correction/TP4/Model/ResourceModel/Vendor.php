<?php
namespace Correction\TP4\Model\ResourceModel;

use Correction\TP4\Api\Data\VendorInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Vendor extends AbstractDb
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('tp4_vendor', 'vendor_id');
    }

    /**
     * Load product ids for the vendor.
     *
     * @inheritDoc
     */
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        $connection = $this->getConnection();

        $select = $connection->select()->from(
            'tp4_catalog_product_vendor',
            [ 'product_id ']
        )->where(
            'vendor_id = :vendor_id'
        );

        $productIds = $this->getConnection()->fetchCol($select, [':vendor_id' => $object->getId()]);
        $object->setProductIds($productIds);

        return $this;
    }

    /**
     * Save product ids set on the vendor.
     *
     * @inheritDoc
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $connection = $this->getConnection();

        $connection->delete(
            'tp4_catalog_product_vendor',
            ['vendor_id = ?' => $object->getId()]
        );

        $vendorId = $object->getId();

        /** @var array $data */
        $data = $object->getProductIds();
        array_walk($data, function (&$val) use ($vendorId) {
            $val = [ $vendorId, $val ];
            return $val;
        });

        $connection->insertArray(
            'tp4_catalog_product_vendor',
            [ 'vendor_id', 'product_id' ],
            $data
        );

        return $this;
    }
}