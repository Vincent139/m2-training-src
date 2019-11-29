<?php

namespace Correction\TP10\Plugin;

class GetIdFieldNameVendorFix
{
    /**
     * Id field name getter
     *
     * @return string
     */
    public function afterGetIdFieldName(\Correction\TP4\Model\ResourceModel\Vendor\Collection $subject, $result)
    {
        return 'vendor_id';
    }
}