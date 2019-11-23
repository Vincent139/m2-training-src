<?php
namespace Correction\TP7\Plugin\Customer\Block;

use Correction\TP6\Block\Customer\Coordinates;
use Correction\TP7\Observer\AddTrigramDataObserver;

class EnrichAfterGetCustomerData
{
    /**
     * Add trigram to returned data.
     *
     * @param Coordinates $subject
     * @param array $result
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterGetCustomerData(
        Coordinates $subject,
        $result
    ) {
        $customer = $subject->getCustomer();
        if ($customer) {
            $result[AddTrigramDataObserver::TRIGRAM] = $customer->getData(AddTrigramDataObserver::TRIGRAM);
        }

        return $result;
    }
}