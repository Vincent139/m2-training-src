<?php
namespace Correction\TP6\Block\Customer;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Stdlib\DateTime\DateTime as MageDateTime;

class DateTime extends \Magento\Framework\View\Element\Template
{
    /** @var DateTime */
    protected $dateTime;

    /**
     * DateTime constructor.
     *
     * @param MageDateTime $dateTime
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        MageDateTime $dateTime,
        Context $context,
        array $data = []
    ) {
        $this->dateTime = $dateTime;

        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getCurrentDataTime()
    {
        return $this->dateTime->date();
    }
}
