<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 13:40
 */

namespace famoser\crm\Models\Database\Base;


use famoser\crm\Models\Database\PaymentModel;
use famoser\crm\Models\Database\PersonModel;

abstract class TimeTaskModel extends NamedPersonalDatabaseModel
{
    private $StartDate;
    private $DeadlineDate;
    private $EndDate;
    private $CostCeiling;
    private $FixPrice;

    private $IsCompleted;
    private $CompletedPercentage;

    private $FinalPrice;
    private $BillingPrice;

    private $IsPayed;
    private $IsArchived;

    private $PaymentId;
    private $Payment;


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
     * @return PaymentModel
     */
    public function getPayment()
    {
        return $this->Payment;
    }

    /**
     * @param PaymentModel $Payment
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
     * @return mixed
     */
    public function getBillingPrice()
    {
        return $this->BillingPrice;
    }

    /**
     * @param mixed $BillingPrice
     */
    public function setBillingPrice($BillingPrice)
    {
        $this->BillingPrice = $BillingPrice;
    }

    /**
     * @return mixed
     */
    public function getIsPayed()
    {
        return $this->IsPayed;
    }

    /**
     * @param mixed $IsPayed
     */
    public function setIsPayed($IsPayed)
    {
        $this->IsPayed = $IsPayed;
    }

    /**
     * @return mixed
     */
    public function getFixPrice()
    {
        return $this->FixPrice;
    }

    /**
     * @param mixed $FixPrice
     */
    public function setFixPrice($FixPrice)
    {
        $this->FixPrice = $FixPrice;
    }
}