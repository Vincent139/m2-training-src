<?php
namespace Correction\TP9\Model\Data;

use Correction\TP9\Api\Data\VendorInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class Vendor extends AbstractExtensibleObject implements VendorInterface
{
    /**
     * Get vendor id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set vendor id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get vendor name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set vendor name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
}
