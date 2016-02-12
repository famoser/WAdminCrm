<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:02
 */

namespace famoser\crm\Models\Database;



use famoser\crm\Models\Database\Base\TimeTaskModel;

class MilestoneModel extends TimeTaskModel
{
    private $ProjectId;
    private $Project;

    private $Procedures = array();

    public function totalCost()
    {
        $total_cost = 0;
        foreach ($this->getProcedures() as $procedure) {
            $total_cost += $procedure->totalCost();
        }
        return $total_cost;
    }

    public function totalWorkingTime()
    {
        $total_time = 0;
        foreach ($this->getProcedures() as $procedure) {
            $total_time += $procedure->totalWorkingTime();
        }
        return $total_time;
    }

    public function getIdentification()
    {
        if ($this->getProject() != null)
            return $this->getName() . " (" . $this->getProject()->getName() . ")";
        return $this->getName();
    }

    public function getDatabaseArray()
    {
        $props = array(
            "ProjectId" => $this->getProjectId()
        );
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return $this->ProjectId;
    }

    /**
     * @param int $ProjectId
     */
    public function setProjectId($ProjectId)
    {
        $this->ProjectId = $ProjectId;
    }

    /**
     * @return ProjectModel
     */
    public function getProject()
    {
        return $this->Project;
    }

    /**
     * @param ProjectModel $Project
     */
    public function setProject($Project)
    {
        $this->Project = $Project;
    }

    /**
     * @return ProcedureModel[]
     */
    public function getProcedures()
    {
        return $this->Procedures;
    }

    /**
     * @param ProcedureModel[] $Procedures
     */
    public function setProcedures(array $Procedures)
    {
        $this->Procedures = $Procedures;
    }
}