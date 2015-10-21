<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:16
 */
class ProjectModel
{

    public $Id;
    public $CustomerId;
    public $Name;
    public $Description;
    public $PaymentPerHour;
    public $IsCompleted;
    public $StartDate;
    public $EndDate;

    public $Customer;
    public $Milestones;

    function TotalCost()
    {
        $totalcost = 0;
        if ($this->Milestones != null)
        {
            foreach ($this->Milestones as $milestone) {
                $totalcost += $milestone->TotalCost();
            }
        }
        return $totalcost;
    }

    function GetFlatIdentification()
    {
        return $this->Name;
    }

    function GetIdentification()
    {
        if ($this->Customer != null)
            return $this->GetFlatIdentification() ." (".$this->Customer->GetFlatIdentification() . ")";
        return $this->Name;
    }
}