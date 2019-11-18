<?php
namespace Correction\TP6\Block\Customer;

class Addresses extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * Addresses constructor.
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
     * Retrieve customer address array
     *
     * @return \Magento\Framework\DataObject[]
     */
    public function getAddresses()
    {

        return $this->customerSession->getCustomer()->getAddresses();
    }
}
