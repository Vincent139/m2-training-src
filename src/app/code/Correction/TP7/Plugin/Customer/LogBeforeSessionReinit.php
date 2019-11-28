<?php
namespace Correction\TP7\Plugin\Customer;

use Correction\TP7\Observer\AddTrigramDataObserver;
use Magento\Customer\Model\Session;
use Psr\Log\LoggerInterface;

class LogBeforeSessionReinit
{
    /** @var LoggerInterface */
    protected $logger;

    /**
     * LogBeforeSessionReinit constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param Session $subject
     * @return void
     */
    public function beforeRegenerateId(
        Session $subject
    ) {
        $this->logger->critical(
            sprintf(
                'Session re-init for customer [%s]',
                $subject->getCustomer()->getData(AddTrigramDataObserver::TRIGRAM)
            )
        );
    }
}
