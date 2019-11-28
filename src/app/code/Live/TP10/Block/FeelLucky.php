<?php
namespace Live\TP10\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;

class FeelLucky extends Template
{
    const FEEL_LUCKY_ENABLED_CONFIG_PATH = 'demo/easysoft_demo_feellucky/enable_feellucky';

    /** @var ScopeConfigInterface */
    protected $scope;

    /**
     * FeelLucky constructor.
     *
     * @param ScopeConfigInterface $scope
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(ScopeConfigInterface $scope, Template\Context $context, array $data = [])
    {
        $this->scope = $scope;

        parent::__construct($context, $data);
    }

    public function isFeelLuckEnabled()
    {
        return (bool)$this->scope->getValue(self::FEEL_LUCKY_ENABLED_CONFIG_PATH);
    }
}
