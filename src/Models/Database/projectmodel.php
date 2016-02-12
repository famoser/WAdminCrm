<?php

use famoser\crm\Models\Database\CustomerModel;
use famoser\crm\Models\Database\MilestoneModel;
use famoser\phpFrame\Models\Database\BaseThingModel;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:16
 */
class ProjectModel extends BaseThingModel
{
    public $IsCompleted;
    public $StartDate;
    public $EndDate;

    private $CustomerId;
    private $Customer;

    private $Milestones = array();

    /**
     * @param CustomerModel $customer
     */
    public function setCustomer($customer)
    {
        $this->Customer = $customer;
    }

    /**
     * @return CustomerModel
     */
    public function getCustomer()
    {
        return $this->Customer;
    }

    /**
     * @param MilestoneModel[] $milestones
     */
    public function setMilestones(array $milestones)
    {
        $this->Milestones = $milestones;
    }

    /**
     * @return MilestoneModel[]
     */
    public function getMilestones()
    {
        return $this->Milestones;
    }

    public function TotalCost()
    {
        $total_cost = 0;
        foreach ($this->getMilestones() as $milestone) {
            $total_cost += $milestone->TotalCost();
        }
        return $total_cost;
    }

    public function TotalWorkingTime()
    {
        $total_time = 0;
        foreach ($this->getMilestones() as $milestone) {
            $total_time += $milestone->TotalWorkingTime();
        }
        return $total_time;
    }

    public function GetIdentification()
    {
        if ($this->Customer != null)
            return $this->getName() . " (" . $this->getCustomer()->getIdentification() . ")";
        return $this->getName();
    }

    public function getDatabaseArray()
    {
        $props = array("IsCompleted" => $this->IsCompleted,
            "StartDate" => $this->StartDate,
            "EndDate" => $this->EndDate
        );
        return array_merge($props, parent::getDatabaseArray());
    }
}