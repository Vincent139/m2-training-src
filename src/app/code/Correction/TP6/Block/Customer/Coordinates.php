<?php
namespace Correction\TP6\Block\Customer;

class Coordinates extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * Coordinates constructor.
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
     * @return array
     */
    public function getCustomerData()
    {
        $customer = $this->customerSession->getCustomer();

        return [
            'name' => $customer->getName(),
            'forname' => $customer->getForname(),
            'email' => $customer->getEmail()
        ];
    }
}
