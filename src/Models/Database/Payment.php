<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 14:00
 */

namespace famoser\crm\Models\Database;


use famoser\crm\Models\Database\Base\BaseThing;

class Payment extends BaseThing
{
    private $Amount;
    private $BillingDate;

    private $IsPaid;
    private $PaymentDate;

    private $CustomerId;
    private $Customer;

    /**
     * @return double
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param double $Amount
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
    }

    /**
     * @return string
     */
    public function getPaymentDate()
    {
        return $this->PaymentDate;
    }

    /**
     * @param string $PaymentDate
     */
    public function setPaymentDate($PaymentDate)
    {
        $this->PaymentDate = $PaymentDate;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->CustomerId;
    }

    /**
     * @param int $CustomerId
     */
    public function setCustomerId($CustomerId)
    {
        $this->CustomerId = $CustomerId;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->Customer;
    }

    /**
     * @param Customer $Customer
     */
    public function setCustomer($Customer)
    {
        $this->Customer = $Customer;
    }

    /**
     * @return string
     */
    public function getBillingDate()
    {
        return $this->BillingDate;
    }

    /**
     * @param string $BillingDate
     */
    public function setBillingDate($BillingDate)
    {
        $this->BillingDate = $BillingDate;
    }

    /**
     * @return bool
     */
    public function getIsPaid()
    {
        return $this->IsPaid;
    }

    /**
     * @param boolean $IsPaid
     */
    public function setIsPaid($IsPaid)
    {
        $this->IsPaid = $IsPaid;
    }

}