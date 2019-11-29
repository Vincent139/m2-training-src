<?php

namespace Correction\TP10\Plugin;

class GetIdFieldNameSeriesFix
{
    /**
     * Id field name getter
     *
     * @return string
     */
    public function afterGetIdFieldName(\Correction\TP4\Model\ResourceModel\Series\Collection $subject, $result)
    {
        return 'series_id';
    }
}