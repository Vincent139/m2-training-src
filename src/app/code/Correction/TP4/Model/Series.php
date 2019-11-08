<?php
namespace Correction\TP4\Model;

use Correction\TP4\Api\Data\SeriesInterface;
use Magento\Framework\Model\AbstractModel;
use Correction\TP4\Model\ResourceModel\Series as SeriesResourceModel;

class Series extends AbstractModel implements SeriesInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(SeriesResourceModel::class);
    }

    /**
     * Get series id
     *
     * @return int
     */
    public function getSeriesId()
    {
        return $this->getData(self::SERIES_ID);
    }

    /**
     * Set series id
     *
     * @param int $seriesId
     * @return $this
     */
    public function setSeriesId(int $seriesId)
    {
        return $this->setData(self::SERIES_ID, $seriesId);
    }

    /**
     * Get series name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set series name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get color value
     *
     * @return string
     */
    public function getColor()
    {
        return $this->getData(self::COLOR);
    }

    /**
     * Set color value
     *
     * @param string $color
     * @return $this
     */
    public function setColor(string $color)
    {
        return $this->setData(self::COLOR, $color);
    }
}
