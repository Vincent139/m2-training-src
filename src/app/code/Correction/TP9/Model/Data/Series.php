<?php
namespace Correction\TP9\Model\Data;

use Correction\TP9\Api\Data\SeriesInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class Series extends AbstractExtensibleObject implements SeriesInterface
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

    /**
     * Series color
     *
     * @return string|null
     */
    public function getColor()
    {
        return $this->_get(self::COLOR);
    }

    /**
     * Set series color
     *
     * @param string $color
     * @return $this
     */
    public function setColor($color)
    {
        return $this->setData(self::COLOR, $color);
    }
}
