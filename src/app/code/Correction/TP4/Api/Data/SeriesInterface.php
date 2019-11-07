<?php
namespace Correction\TP4\Api\Data;

interface SeriesInterface {

    const SERIES_ID = 'series_id';
    const NAME = 'name';
    const COLOR = 'color';

    /**
     * Get series id
     *
     * @return int
     */
    public function getSeriesId();

    /**
     * Set series id
     *
     * @param int $seriesId
     * @return $this
     */
    public function setSeriesId(int $seriesId);

    /**
     * Get series name
     *
     * @return string
     */
    public function getName();

    /**
     * Set series name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

    /**
     * Get color value
     *
     * @return string
     */
    public function getColor();

    /**
     * Set color value
     *
     * @param string $color
     * @return $this
     */
    public function setColor(string $color);
}
