<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:02
 */

namespace famoser\crm\Models\Database;


use famoser\crm\Models\Database\Base\BaseTimeTask;

class Milestone extends BaseTimeTask
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
     * @return Project
     */
    public function getProject()
    {
        return $this->Project;
    }

    /**
     * @param Project $Project
     */
    public function setProject($Project)
    {
        $this->Project = $Project;
    }

    /**
     * @return Procedure[]
     */
    public function getProcedures()
    {
        return $this->Procedures;
    }

    /**
     * @param Procedure[] $Procedures
     */
    public function setProcedures(array $Procedures)
    {
        $this->Procedures = $Procedures;
    }
}