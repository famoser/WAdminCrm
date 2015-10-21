<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:10
 */

class ProcedureModel
{

    public $Id;
    public $MilestoneId;
    public $AdminId;
    public $Name;
    public $Description;
    public $PaymentPerHour;
    public $StartDateTime;
    public $EndDateTime;

    public $Milestone;
    public $Admin;

    function TotalCost()
    {
        $totalcost = $this->PaymentPerHour * format_TimeSpanMinutes($this->StartDateTime, $this->EndDateTime) / 60;
        return $totalcost;
    }

    function GetFlatIdentification()
    {
        return $this->Name;
    }

    function GetIdentification()
    {
        if ($this->Milestone != null)
            return $this->GetFlatIdentification() ." (".$this->Milestone->GetFlatIdentification() . ")";
        return $this->Name;
    }
}