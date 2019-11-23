<?php
namespace Correction\TP7\Plugin\Customer;

use Magento\Customer\Model\ResourceModel\Customer as CustomerResourceModel;
use Magento\Customer\Model\Customer as CustomerModel;

class EnrichRandomAroundLoad
{
    const RANDOM = 'random';

    const FIRSTNAME = [ 'Riri', 'Fifi', 'Loulou' ];
    const LASTNAME = [ 'Pic', 'Ric' ];
    const EMAIL = [ 'anonymous@hidden.org', 'enhaut@adroite.net', 'lucy@thesky.uk' ];

    /**
     * Decorate model with random data instead of legacy load if 'random' data equals to true is set on model data.
     *
     * @param CustomerResourceModel $subject
     * @param \Closure $proceed
     * @param CustomerModel $object
     * @param int $entityId
     * @param array|null $attributes
     * @return CustomerResourceModel
     */
    public function aroundLoad(
        CustomerResourceModel $subject,
        \Closure $proceed,
        $object,
        $entityId,
        $attributes = []
    ) {
        if ($object->getData(self::RANDOM) === true) {
            $object->beforeLoad($entityId);
            $object
                ->setData('firstname', self::FIRSTNAME[rand(0, sizeof(self::FIRSTNAME) - 1)])
                ->setData('lastname', self::LASTNAME[rand(0, sizeof(self::LASTNAME) - 1)])
                ->setData('email', self::EMAIL[rand(0, sizeof(self::EMAIL) - 1)]);
            $object->afterLoad();
            $object->setOrigData();
            $object->setHasDataChanges(false);
        } else {
            $proceed($object, $entityId, $attributes);
        }

        return $subject;
    }
}