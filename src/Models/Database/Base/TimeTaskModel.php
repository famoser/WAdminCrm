<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 13:40
 */

namespace famoser\crm\Models\Database\Base;


use famoser\crm\Models\Database\PaymentModel;
use famoser\phpFrame\Models\Database\BaseThingModel;

class TimeTaskModel extends BaseThingModel
{
    private $StartDate;
    private $DeadlineDate;
    private $EndDate;

    private $FinalPrice;
    private $CostCeiling;

    private $IsCompleted;
    private $PercentageComplete;

    private $IsArchived;

    private $PaymentId;
    private $Payment;

    public function getDatabaseArray()
    {
        $props = array("StartDate" => $this->getStartDate(),
            "DeadlineDate" => $this->getDeadlineDate(),
            "EndDate" => $this->getEndDate(),
            "CostCeiling" => $this->getCostCeiling(),
            "PercentageComplete" => $this->getPercentageComplete(),
            "IsArchived" => $this->getIsArchived(),
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
    public function getPercentageComplete()
    {
        return $this->PercentageComplete;
    }

    /**
     * @param int $PercentageComplete
     */
    public function setPercentageComplete($PercentageComplete)
    {
        $this->PercentageComplete = $PercentageComplete;
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
}