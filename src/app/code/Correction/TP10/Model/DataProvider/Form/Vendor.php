<?php

namespace Correction\TP10\Model\DataProvider\Form;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Vendor extends \Correction\TP10\Model\DataProvider\Vendor
{
    public function getData()
    {
        $data = parent::getData();
        $resultData = [];
        if(isset($data['items']) && $data['items'])
        {
            foreach($data['items'] as $itemData)
            {
                $resultData[$itemData['vendor_id']] = $itemData;
            }
        }
        return $resultData;
    }
}