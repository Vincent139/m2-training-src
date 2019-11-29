<?php

namespace Correction\TP10\Model\DataProvider\Form;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Series
 * @package Correction\TP10\Model\DataProvider\Form
 */
class Series extends \Correction\TP10\Model\DataProvider\Series
{
    /**
     * @return array
     */
    public function getData()
    {
        $data = parent::getData();
        $resultData = [];
        if(isset($data['items']) && $data['items'])
        {
            foreach($data['items'] as $itemData)
            {
                $resultData[$itemData['series_id']] = $itemData;
            }
        }
        return $resultData;
    }
}