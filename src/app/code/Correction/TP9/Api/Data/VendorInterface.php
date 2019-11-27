<?php
namespace Correction\TP9\Api\Data;

/**
 * @api
 */
interface VendorInterface
{
    const ID = 'id';
    const NAME = 'name';

    /**
     * Vendor id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set vendor id
     *
     * @param int $vendorId
     * @return $this
     */
    public function setId($vendorId);

    /**
     * Vendor name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set vendor name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);
}
