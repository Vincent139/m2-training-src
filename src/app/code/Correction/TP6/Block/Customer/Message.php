<?php
namespace Correction\TP6\Block\Customer;

class Message extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * Message constructor.
     *
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->customerSession = $customerSession;

        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return 'Bienvenue sur le TP6 !';
    }

    /**
     * @return string
     */
    public function getCurrentDataTime()
    {
        return 'abcd';
    }
}
