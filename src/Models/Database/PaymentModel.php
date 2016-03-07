<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 14:00
 */

namespace famoser\crm\Models\Database;


use famoser\crm\Models\Database\Base\NamedDatabaseModel;
use famoser\phpFrame\Core\Logging\LogHelper;

class PaymentModel extends NamedDatabaseModel
{
    const PAYMENT_CASH = 1;
    const PAYMENT_BANK_TRANSFER = 2;

    private $BillingAmount;
    private $BillingDate;
    private $BillingIdentification;

    private $IsPaid;
    private $PaymentAmount;
    private $PaymentDate;
    private $PaymentType;

    private $PayedByPersonId;
    private $PayedByPerson;

    public function getPaymentTypeText($const)
    {
        if ($const == PaymentModel::PAYMENT_CASH)
            return "cash";
        if ($const == PaymentModel::PAYMENT_BANK_TRANSFER)
            return "bank transfer";

        LogHelper::getInstance()->logError("unknown const: " . $const);
        return "unknown";
    }

    /**
     * @return double
     */
    public function getBillingAmount()
    {
        return $this->BillingAmount;
    }

    /**
     * @param double $BillingAmount
     */
    public function setBillingAmount($BillingAmount)
    {
        $this->BillingAmount = $BillingAmount;
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
    public function getPayedByPersonId()
    {
        return $this->PayedByPersonId;
    }

    /**
     * @param int $PayedByPersonId
     */
    public function setPayedByPersonId($PayedByPersonId)
    {
        $this->PayedByPersonId = $PayedByPersonId;
    }

    /**
     * @return CustomerModel
     */
    public function getPayedByPerson()
    {
        return $this->PayedByPerson;
    }

    /**
     * @param CustomerModel $PayedByPerson
     */
    public function setPayedByPerson($PayedByPerson)
    {
        $this->PayedByPerson = $PayedByPerson;
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

    /**
     * @return mixed
     */
    public function getPaymentAmount()
    {
        return $this->PaymentAmount;
    }

    /**
     * @param mixed $PaymentAmount
     */
    public function setPaymentAmount($PaymentAmount)
    {
        $this->PaymentAmount = $PaymentAmount;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->PaymentType;
    }

    /**
     * @param mixed $PaymentType
     */
    public function setPaymentType($PaymentType)
    {
        $this->PaymentType = $PaymentType;
    }

    /**
     * @return mixed
     */
    public function getBillingIdentification()
    {
        return $this->BillingIdentification;
    }

    /**
     * @param mixed $BillingIdentification
     */
    public function setBillingIdentification($BillingIdentification)
    {
        $this->BillingIdentification = $BillingIdentification;
    }

}