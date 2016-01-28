<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:02
 */

class MilestoneModel
{

    public $Id;
    public $ProjectId;
    public $Name;
    public $Description;
    public $StartDate;
    public $DeadlineDate;
    public $EndDate;
    public $CostCeiling;
    public $PercentageComplete;
    public $PaymentPerHour;

    public $Project;
    public $Procedures;

    function TotalCost()
    {
        $totalcost = 0;
        if ($this->Procedures != null)
        {
            foreach ($this->Procedures as $procedures) {
                $totalcost += $procedures->TotalCost();
            }
        }
        return $totalcost;
    }

    function TotalWorkingTime()
    {
        $total_time = 0;
        if ($this->Procedures != null) {
            foreach ($this->Procedures as $procedures) {
                $total_time += $procedures->TotalWorkingTime();
            }
        }
        return $total_time;
    }

    function GetFlatIdentification()
    {
        return $this->Name;
    }

    function GetIdentification()
    {
        if ($this->Project != null)
            return $this->GetFlatIdentification() ." (".$this->Project->GetFlatIdentification() . ")";
        return $this->Name;
    }
}