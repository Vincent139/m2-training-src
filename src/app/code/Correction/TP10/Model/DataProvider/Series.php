<?php

namespace Correction\TP10\Model\DataProvider;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Series extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    public function __construct($name, $primaryFieldName, $requestFieldName,
        \Correction\TP4\Model\ResourceModel\Series\CollectionFactory $collectionFactory, array $meta = [], array $data = [])
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}