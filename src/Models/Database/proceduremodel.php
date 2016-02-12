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


    /**
     * @param AdminModel $admin
     */
    public function setAdmin(AdminModel $admin)
    {
        $this->Admin = $admin;
    }

    /**
     * @return AdminModel
     */
    public function getAdmin()
    {
        return $this->Admin;
    }

    /**
     * @param MilestoneModel $milestone
     */
    public function setMilestone(MilestoneModel $milestone)
    {
        $this->Milestone = $milestone;
    }

    /**
     * @return MilestoneModel
     */
    public function getMilestone()
    {
        return $this->Milestone;
    }

    public function TotalCost()
    {
        $total_cost = $this->PaymentPerHour * FormatHelper::getInstance()->timeSpanMinutesShort($this->StartDateTime, $this->EndDateTime) / 60;
        return $total_cost;
    }

    public function TotalWorkingTime()
    {
        $total_time = FormatHelper::getInstance()->timeSpanMinutesShort($this->StartDateTime, $this->EndDateTime);
        return $total_time;
    }

    public function GetIdentification()
    {
        if ($this->Milestone != null)
            return $this->getName() . " (" . $this->getMilestone()->getName() . ")";
        return $this->Name;
    }

    public function getDatabaseArray()
    {
        $props = array("PaymentPerHour" => $this->PaymentPerHour,
            "StartDateTime" => $this->StartDateTime,
            "EndDateTime" => $this->EndDateTime,
            "MilestoneId" => $this->MilestoneId,
            "AdminId" => $this->AdminId
        );
        return array_merge($props, parent::getDatabaseArray());
    }
}