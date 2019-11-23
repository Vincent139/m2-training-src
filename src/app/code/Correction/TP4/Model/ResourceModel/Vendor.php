<?php
namespace Correction\TP4\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel as AbstractModel;
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
    protected function _afterLoad(AbstractModel $object)
    {
        $connection = $this->getConnection();

        $select = $connection->select()->from(
            'tp4_catalog_product_vendor',
            [ 'product_id ']
        )->where(
            'vendor_id = :vendor_id'
        );

        $productIds = $connection->fetchCol($select, [':vendor_id' => $object->getId()]);
        $object->setData('product_ids', $productIds);

        return $this;
    }

    /**
     * Save product ids set on the vendor.
     *
     * @inheritDoc
     */
    protected function _afterSave(AbstractModel $object)
    {
        $connection = $this->getConnection();

        $connection->delete(
            'tp4_catalog_product_vendor',
            ['vendor_id = ?' => $object->getId()]
        );

        $vendorId = $object->getId();

        /** @var array $data */
        $data = $object->getData('product_ids');
        if ($data) {
            array_walk($data, function (&$val) use ($vendorId) {
                $val = [$vendorId, $val];
                return $val;
            });

            $connection->insertArray(
                'tp4_catalog_product_vendor',
                ['vendor_id', 'product_id'],
                $data
            );
        } else {
            $connection->delete(
                'tp4_catalog_product_vendor',
                [ 'vendor_id = ?' => $vendorId ]
            );
        }

        return $this;
    }
}
