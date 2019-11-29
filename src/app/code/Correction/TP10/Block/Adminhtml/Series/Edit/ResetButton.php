<?php

namespace Correction\TP10\Block\Adminhtml\Series\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ResetButton extends \Correction\TP10\Block\Adminhtml\Series\Edit\GenericButton
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'on_click' => "location.reload();",
            'sort_order' => 20
        ];
    }
}