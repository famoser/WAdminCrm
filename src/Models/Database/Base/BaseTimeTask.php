<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 13:40
 */

namespace famoser\crm\Models\Database\Base;


use famoser\crm\Models\Database\Payment;
use famoser\crm\Models\Database\Person;

abstract class BaseTimeTask extends BaseThing
{
    private $StartDate;
    private $DeadlineDate;
    private $EndDate;

    private $FinalPrice;
    private $CostCeiling;

    private $IsCompleted;
    private $CompletedPercentage;

    private $IsArchived;

    private $PersonId;
    private $Person;

    private $PaymentId;
    private $Payment;

    public function getDatabaseArray()
    {
        $props = array("StartDate" => $this->getStartDate(),
            "DeadlineDate" => $this->getDeadlineDate(),
            "EndDate" => $this->getEndDate(),
            "CostCeiling" => $this->getCostCeiling(),
            "PercentageComplete" => $this->getCompletedPercentage(),
            "IsArchived" => $this->getIsArchived(),
            "PersonId" => $this->getPersonId(),
            "PaymentId" => $this->getPaymentId()
        );
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->StartDate;
    }

    /**
     * @param string $StartDate
     */
    public function setStartDate($StartDate)
    {
        $this->StartDate = $StartDate;
    }

    /**
     * @return string
     */
    public function getDeadlineDate()
    {
        return $this->DeadlineDate;
    }

    /**
     * @param string $DeadlineDate
     */
    public function setDeadlineDate($DeadlineDate)
    {
        $this->DeadlineDate = $DeadlineDate;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->EndDate;
    }

    /**
     * @param string $EndDate
     */
    public function setEndDate($EndDate)
    {
        $this->EndDate = $EndDate;
    }

    /**
     * @return int
     */
    public function getCostCeiling()
    {
        return $this->CostCeiling;
    }

    /**
     * @param int $CostCeiling
     */
    public function setCostCeiling($CostCeiling)
    {
        $this->CostCeiling = $CostCeiling;
    }

    /**
     * @return int
     */
    public function getCompletedPercentage()
    {
        return $this->CompletedPercentage;
    }

    /**
     * @param int $CompletedPercentage
     */
    public function setCompletedPercentage($CompletedPercentage)
    {
        $this->CompletedPercentage = $CompletedPercentage;
    }

    /**
     * @return bool
     */
    public function getIsArchived()
    {
        return $this->IsArchived;
    }

    /**
     * @param boolean $IsArchived
     */
    public function setIsArchived($IsArchived)
    {
        $this->IsArchived = $IsArchived;
    }

    /**
     * @return int
     */
    public function getPaymentId()
    {
        return $this->PaymentId;
    }

    /**
     * @param int $PaymentId
     */
    public function setPaymentId($PaymentId)
    {
        $this->PaymentId = $PaymentId;
    }

    /**
     * @return Payment
     */
    public function getPayment()
    {
        return $this->Payment;
    }

    /**
     * @param Payment $Payment
     */
    public function setPayment($Payment)
    {
        $this->Payment = $Payment;
    }

    /**
     * @return double
     */
    public function getFinalPrice()
    {
        return $this->FinalPrice;
    }

    /**
     * @param double $FinalPrice
     */
    public function setFinalPrice($FinalPrice)
    {
        $this->FinalPrice = $FinalPrice;
    }

    /**
     * @return bool
     */
    public function getIsCompleted()
    {
        return $this->IsCompleted;
    }

    /**
     * @param boolean $IsCompleted
     */
    public function setIsCompleted($IsCompleted)
    {
        $this->IsCompleted = $IsCompleted;
    }

    /**
     * @return int
     */
    public function getPersonId()
    {
        return $this->PersonId;
    }

    /**
     * @param int $PersonId
     */
    public function setPersonId($PersonId)
    {
        $this->PersonId = $PersonId;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->Person;
    }

    /**
     * @param Person $Person
     */
    public function setPerson($Person)
    {
        $this->Person = $Person;
    }
}