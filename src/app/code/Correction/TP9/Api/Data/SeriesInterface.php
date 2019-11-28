<?php
namespace Correction\TP9\Api\Data;

/**
 * @api
 */
interface SeriesInterface
{
    const ID = 'id';
    const NAME = 'name';
    const COLOR = 'color';

    /**
     * Series id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set series id
     *
     * @param int $seriesId
     * @return $this
     */
    public function setId($seriesId);

    /**
     * Series name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set series name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Series color
     *
     * @return string|null
     */
    public function getColor();

    /**
     * Set series color
     *
     * @param string $color
     * @return $this
     */
    public function setColor($color);
}
