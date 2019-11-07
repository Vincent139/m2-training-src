<?php
namespace Correction\TP4\Api\Data;

interface VendorInterface {

    const VENDOR_ID = 'vendor_id';
    const NAME = 'name';

    /**
     * Get vendor id
     *
     * @return int
     */
    public function getVendorId();

    /**
     * Set vendor id
     *
     * @param int $vendorId
     * @return $this
     */
    public function setVendorId(int $vendorId);

    /**
     * Get vendor name
     *
     * @return string
     */
    public function getName();

    /**
     * Set vendor name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name);
}
