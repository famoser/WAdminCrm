<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:10
 */

namespace famoser\crm\Models\Database;


use famoser\phpFrame\Helpers\FormatHelper;
use famoser\phpFrame\Models\Database\BaseThingModel;

class ProcedureModel extends BaseThingModel
{
    private $PaymentPerHour;
    private $StartDateTime;
    private $EndDateTime;

    private $MilestoneId;
    private $Milestone;

    private $AdminId;
    private $Admin;

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

    public function getDatabaseArray()
    {
        $props = array("PaymentPerHour" => $this->getPaymentPerHour(),
            "StartDateTime" => $this->getStartDateTime(),
            "EndDateTime" => $this->getEndDateTime(),
            "MilestoneId" => $this->getMilestoneId(),
            "AdminId" => $this->getAdminId()
        );
        return array_merge($props, parent::getDatabaseArray());
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
     * @return int
     */
    public function getAdminId()
    {
        return $this->AdminId;
    }

    /**
     * @param int $AdminId
     */
    public function setAdminId($AdminId)
    {
        $this->AdminId = $AdminId;
    }

    /**
     * @return AdminModel
     */
    public function getAdmin()
    {
        return $this->Admin;
    }

    /**
     * @param AdminModel $Admin
     */
    public function setAdmin($Admin)
    {
        $this->Admin = $Admin;
    }
}