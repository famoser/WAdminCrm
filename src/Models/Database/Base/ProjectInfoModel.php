<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 19.02.2016
 * Time: 19:55
 */

namespace famoser\crm\Models\Database\Base;


use famoser\crm\Models\Database\ProjectModel;

abstract class ProjectInfoModel extends NamedPersonalDatabaseModel
{
    private $ProjectId;
    private $Project;

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

}