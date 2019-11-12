<?php
namespace Correction\TP5\Model\Product\Attribute\Source;

use Correction\TP4\Model\ResourceModel\Series\CollectionFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource as AbstractSource;

class Series extends AbstractSource
{
    /** @var CollectionFactory */
    protected $collectionFactory;

    /**
     * Series constructor.
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @inheritdoc
     */
    public function getAllOptions()
    {
        if ($this->_options == null) {
            $options = [];
            $collection = $this->collectionFactory->create();
            /** @var \Correction\TP4\Model\Series $item */
            foreach ($collection as $item) {
                $options[] = [ 'label' => $item->getName(), 'value' => $item->getSeriesId() ];
            }
            $this->_options = $options;
        }

        return $this->_options;
    }
}
