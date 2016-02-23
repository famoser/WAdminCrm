<?php

namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\Base\BaseTimeTask;


/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:16
 */
class Project extends BaseTimeTask
{
    private $CustomerId;
    private $Customer;

    private $Milestones;

    public function totalCost()
    {
        $total_cost = 0;
        foreach ($this->getMilestones() as $milestone) {
            $total_cost += $milestone->TotalCost();
        }
        return $total_cost;
    }

    public function totalWorkingTime()
    {
        $total_time = 0;
        foreach ($this->getMilestones() as $milestone) {
            $total_time += $milestone->TotalWorkingTime();
        }
        return $total_time;
    }

    public function getIdentification()
    {
        if ($this->Customer != null)
            return $this->getName() . " (" . $this->getCustomer()->getIdentification() . ")";
        return $this->getName();
    }

    public function getDatabaseArray()
    {
        $props = array("CustomerId" => $this->getCustomerId());
        return array_merge($props, parent::getDatabaseArray());
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
     * @return Milestone[]
     */
    public function getMilestones()
    {
        return $this->Milestones;
    }

    /**
     * @param Milestone[] $Milestones
     */
    public function setMilestones(array $Milestones)
    {
        $this->Milestones = $Milestones;
    }
}