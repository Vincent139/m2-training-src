<?php
namespace Correction\TP6\Block\Customer;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Session;

class Coordinates extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /** @var CustomerRepositoryInterface */
    protected $customerRepository;

    /**
     * Coordinates constructor.
     *
     * @param \Magento\Customer\Model\Session $customerSession
     * @param CustomerRepositoryInterface $customerRepository
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;

        parent::__construct($context, $data);
    }

    /**
     * Return the logged in customer if any, null otherwise.
     *
     * @return Customer|null
     */
    public function getCustomer()
    {
        if ($this->customerSession->isLoggedIn()) {
            return $this->customerSession->getCustomer();
        } else {
            return null;
        }
    }

    /**
     * Return assoc array with entries name, firstname, email.
     *
     * @return array
     */
    public function getCustomerData()
    {
        $customer = $this->getCustomer();

        if ($customer) {
            return [
                'name' => $customer->getData('lastname'),
                'firstname' => $customer->getData('firstname'),
                'email' => $customer->getEmail()
            ];
        } else {
            return [];
        }
    }
}
