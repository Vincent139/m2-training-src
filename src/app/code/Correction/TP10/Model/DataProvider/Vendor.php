<?php

namespace Correction\TP10\Model\DataProvider;

class Vendor extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    public function __construct($name, $primaryFieldName, $requestFieldName,
        \Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory $collectionFactory, array $meta = [], array $data = [])
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}