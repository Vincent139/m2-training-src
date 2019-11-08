<?php
namespace Correction\TP4\Model;

use Correction\TP4\Api\Data\VendorInterface;
use Magento\Framework\Model\AbstractModel;
use Correction\TP4\Model\ResourceModel\Vendor as VendorResourceModel;

class Vendor extends AbstractModel implements VendorInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(VendorResourceModel::class);
    }

    /**
     * Get vendor id
     *
     * @return int
     */
    public function getVendorId()
    {
        return $this->getData(self::VENDOR_ID);
    }

    /**
     * Set vendor id
     *
     * @param int $vendorId
     * @return $this
     */
    public function setVendorId(int $vendorId)
    {
        return $this->setData(self::VENDOR_ID, $vendorId);
    }

    /**
     * Get vendor name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set vendor name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        return $this->setData(self::NAME, $name);
    }
}
