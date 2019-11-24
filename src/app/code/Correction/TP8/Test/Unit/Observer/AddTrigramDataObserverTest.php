<?php
namespace Correction\TP8\Test\Unit\Observer;

use Correction\TP7\Observer\AddTrigramDataObserver;
use Magento\Customer\Model\Customer;
use Magento\Framework\Event;

class AddTrigramDataObserverTest extends \PHPUnit\Framework\TestCase
{
    protected $customer;

    /** @var Event\Observer */
    protected $observer;

    /** @var AddTrigramDataObserver */
    protected $addTrigramDataObserver;

    /** @var string */
    private $key;

    /** @var string */
    private $value;

    public function setUpCustomer()
    {
        $this->customer = $this->createPartialMock(
            Customer::class,
            [ 'getData', 'setData' ]
        );

        $this->customer
            ->expects($this->at(0))
            ->method('getData')
            ->with($this->equalTo('firstname'))
            ->will($this->returnValue('Alain'));

        $this->customer
            ->expects($this->at(1))
            ->method('getData')
            ->with($this->equalTo('lastname'))
            ->will($this->returnValue('Dupont'));

        $this->customer
            ->method('setData')
            ->willReturnCallback(function ($key, $value) {
                $this->key = $key;
                $this->value = $value;

                return $this->customer;
            });

        $this->observer = new Event\Observer([ 'event' => new Event([ 'customer' => $this->customer ]) ]);

        $this->addTrigramDataObserver = new AddTrigramDataObserver();
    }

    public function testSimple()
    {
        $this->assertGreaterThan(1, 2, '** the world has definitely gone mad');
    }

    public function testTrigramIsEqual()
    {
        $this->key = $this->value = null;

        $this->setUpCustomer();

        $this->addTrigramDataObserver->execute($this->observer);

        $this->assertEquals(AddTrigramDataObserver::TRIGRAM, $this->key, '** key is not as expected');
        $this->assertEquals('ADU', $this->value, 'value is not as expected');
    }

    public function testTrigramIsNotEqual()
    {
        $this->key = $this->value = null;

        $this->setUpCustomer();

        $this->addTrigramDataObserver->execute($this->observer);

        $this->assertEquals(AddTrigramDataObserver::TRIGRAM, $this->key, '** key is not as expected');
        $this->assertNotEquals('ADL', $this->value, 'value is not... not as expected');
    }
}
