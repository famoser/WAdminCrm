<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:10
 */

namespace famoser\crm\Models\Database;


use famoser\crm\Models\Database\Base\NamedPersonalDatabaseModel;
use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\FormatHelper;

class ProcedureModel extends NamedPersonalDatabaseModel
{
    const PROCEDURE_PAYED = 1;
    const PROCEDURE_NOT_PAYED = 2;

    private $PaymentPerHour;
    private $StartDateTime;
    private $EndDateTime;

    private $ProcedureType;

    private $MilestoneId;
    private $Milestone;


    public function getPaymentTypeText($const)
    {
        if ($const == ProcedureModel::PROCEDURE_PAYED)
            return "payed";
        if ($const == ProcedureModel::PROCEDURE_NOT_PAYED)
            return "not payed";

        LogHelper::getInstance()->logError("unknown const: " . $const);
        return "unknown";
    }

    public function totalCost()
    {
        $total_cost = $this->getPaymentPerHour() * FormatHelper::getInstance()->timeSpanMinutesShort($this->getStartDateTime(), $this->getEndDateTime()) / 60;
        return $total_cost;
    }

    public function totalWorkingTime()
    {
        $total_time = FormatHelper::getInstance()->timeSpanMinutesShort($this->getStartDateTime(), $this->getEndDateTime());
        return $total_time;
    }

    public function getIdentification()
    {
        if ($this->getMilestone() != null)
            return $this->getName() . " (" . $this->getMilestone()->getName() . ")";
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getPaymentPerHour()
    {
        return $this->PaymentPerHour;
    }

    /**
     * @param int $PaymentPerHour
     */
    public function setPaymentPerHour($PaymentPerHour)
    {
        $this->PaymentPerHour = $PaymentPerHour;
    }

    /**
     * @return string
     */
    public function getStartDateTime()
    {
        return $this->StartDateTime;
    }

    /**
     * @param string $StartDateTime
     */
    public function setStartDateTime($StartDateTime)
    {
        $this->StartDateTime = $StartDateTime;
    }

    /**
     * @return string
     */
    public function getEndDateTime()
    {
        return $this->EndDateTime;
    }

    /**
     * @param string $EndDateTime
     */
    public function setEndDateTime($EndDateTime)
    {
        $this->EndDateTime = $EndDateTime;
    }

    /**
     * @return int
     */
    public function getMilestoneId()
    {
        return $this->MilestoneId;
    }

    /**
     * @param int $MilestoneId
     */
    public function setMilestoneId($MilestoneId)
    {
        $this->MilestoneId = $MilestoneId;
    }

    /**
     * @return MilestoneModel
     */
    public function getMilestone()
    {
        return $this->Milestone;
    }

    /**
     * @param MilestoneModel $Milestone
     */
    public function setMilestone($Milestone)
    {
        $this->Milestone = $Milestone;
    }

    /**
     * @return mixed
     */
    public function getProcedureType()
    {
        return $this->ProcedureType;
    }

    /**
     * @param mixed $ProcedureType
     */
    public function setProcedureType($ProcedureType)
    {
        $this->ProcedureType = $ProcedureType;
    }
}