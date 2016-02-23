<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 19.02.2016
 * Time: 19:55
 */

namespace famoser\crm\Models\Database\Base;


use famoser\crm\Models\Database\Project;

class BaseProjectInfo extends BasePersonalThing
{
    private $ProjectId;
    private $Project;

    public function getDatabaseArray()
    {
        $props = array(
            "ProjectId" => $this->getProjectId()
        );
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->ProjectId;
    }

    /**
     * @param mixed $ProjectId
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

}