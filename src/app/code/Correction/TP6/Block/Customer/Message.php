<?php
namespace Correction\TP6\Block\Customer;

use Magento\Framework\Stdlib\DateTime\DateTime;

class Message extends \Magento\Framework\View\Element\Template
{
    /** @var DateTime */
    protected $dateTime;

    /**
     * Message constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        DateTime $dateTime,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->dateTime = $dateTime;

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
        return $this->dateTime->date();
    }
}
