<?php
namespace Correction\TP7\Observer;

use Magento\Customer\Model\Customer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddTrigramDataObserver implements ObserverInterface
{
    const TRIGRAM = 'trigram';

    /**
     * Add trigram data to customer.
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /** @var Customer $customer */
        $customer = $observer->getEvent()->getData('customer');

        $customer->setData(
            self::TRIGRAM,
            $customer->getData('firstname')[0].strtoupper(substr($customer->getData('lastname'), 0, 2))
        );
    }
}