<?php
namespace Correction\TP10\Catalog\Block\Adminhtml;

use Magento\Backend\Block\Widget\Container;

/**
 * @api
 */
class Series extends \Magento\Backend\Block\Widget\Container
{
    /**
     * Prepare button and grid
     *
     * @return Container
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id' => 'add_new_series',
            'label' => __('Add Series'),
            'class' => 'add',
            'button_class' => '',
            'class_name' => \Magento\Backend\Block\Widget\Button::class,
            'onclick' => "setLocation('" . $this->getUrl('extra/*/new') . "')"
        ];
        $this->buttonList->add('add_new', $addButtonProps);

        return parent::_prepareLayout();
    }

    /**
     * Check whether it is single store mode
     *
     * @return bool
     */
    public function isSingleStoreMode()
    {
        return $this->_storeManager->isSingleStoreMode();
    }
}
