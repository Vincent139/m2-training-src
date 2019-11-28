<?php
namespace Correction\TP10\Ui\Component\Series\Listing;

/**
 * @api
 */
class Columns extends \Magento\Ui\Component\Listing\Columns
{
    /**
     * Default columns max order
     */
    const DEFAULT_COLUMNS_MAX_ORDER = 100;

    /** @var \Magento\Catalog\Ui\Component\ColumnFactory */
    protected $columnFactory;

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Catalog\Ui\Component\ColumnFactory $columnFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Ui\Component\ColumnFactory $columnFactory,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        array $components = [],
        array $data = []
    ) {
        $this->columnFactory = $columnFactory;

        parent::__construct($context, $components, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function prepare()
    {
        $columnSortOrder = self::DEFAULT_COLUMNS_MAX_ORDER;
        foreach ([ 'id', 'name', 'color' ] as $columnName) {
            $config = [];
            if (!isset($this->components[$columnName])) {
                $config['sortOrder'] = ++$columnSortOrder;
                $config['filter'] = 'text';
                $column = $this->columnFactory->create($columnName, $this->getContext(), $config);
                $column->prepare();
                $this->addComponent($columnName, $column);
            }
        }
        parent::prepare();
    }
}
