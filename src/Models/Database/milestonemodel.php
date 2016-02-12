<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:02
 */

namespace famoser\crm\Models\Database;


use famoser\phpFrame\Models\Database\BaseThingModel;
use ProjectModel;

class MilestoneModel extends BaseThingModel
{
    private $StartDate;
    private $DeadlineDate;
    private $EndDate;
    private $CostCeiling;
    private $PercentageComplete;
    private $PaymentPerHour;

    private $ProjectId;
    private $Project;

    private $Procedures = array();


    /**
     * @param ProjectModel $project
     */
    public function setProject(ProjectModel $project)
    {
        $this->Project = $project;
    }

    /**
     * @return ProjectModel
     */
    public function getProject()
    {
        return $this->Project;
    }

    /**
     * @param ProcedureModel[] $procedures
     */
    public function setProcedures(array $procedures)
    {
        $this->Procedures = $procedures;
    }

    /**
     * @return ProcedureModel[]
     */
    public function getProcedures()
    {
        return $this->Procedures;
    }

    public function TotalCost()
    {
        $total_cost = 0;
        foreach ($this->getProcedures() as $procedure) {
            $total_cost += $procedure->TotalCost();
        }
        return $total_cost;
    }

    public function TotalWorkingTime()
    {
        $total_time = 0;
        foreach ($this->getProcedures() as $procedure) {
            $total_time += $procedure->TotalWorkingTime();
        }
        return $total_time;
    }

    public function GetIdentification()
    {
        if ($this->Project != null)
            return $this->getName() . " (" . $this->getProject()->getName() . ")";
        return $this->Name;
    }

    public function getDatabaseArray()
    {
        $props = array("StartDate" => $this->StartDate,
            "DeadlineDate" => $this->DeadlineDate,
            "EndDate" => $this->EndDate,
            "CostCeiling" => $this->CostCeiling,
            "PercentageComplete" => $this->PercentageComplete,
            "PaymentPerHour" => $this->PaymentPerHour,
            "ProjectId" => $this->ProjectId
        );
        return array_merge($props, parent::getDatabaseArray());
    }
}