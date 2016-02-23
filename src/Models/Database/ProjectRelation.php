<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 19.02.2016
 * Time: 20:13
 */

namespace famoser\crm\Models\Database;


use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Models\Database\BaseDatabaseModel;

class ProjectRelation extends BaseDatabaseModel
{
    const PROJECT_MANAGER = 1;
    const PROJECT_PARTICIPANT = 2;
    const PROJECT_VIEWER = 3;

    private $ProjectRelationType;

    private $ProjectId;
    private $Project;

    private $AdminId;
    private $Admin;

    public function getIdentification()
    {
        return $this->getProjectRelationTypeAsText();
    }

    public function getProjectRelationTypeText($const)
    {
        if ($const == ProjectRelation::PROJECT_MANAGER)
            return "project manager";
        if ($const == ProjectRelation::PROJECT_PARTICIPANT)
            return "project participant";
        if ($const == ProjectRelation::PROJECT_VIEWER)
            return "project viewer";

        LogHelper::getInstance()->logError("unknown const: " . $const);
        return "unknown";
    }

    public function getProjectRelationTypeAsText()
    {
        return $this->getProjectRelationTypeText($this->getProjectRelationType());
    }

    /**
     * @return mixed
     */
    public function getProjectRelationType()
    {
        return $this->ProjectRelationType;
    }

    /**
     * @param mixed $ProjectRelationType
     */
    public function setProjectRelationType($ProjectRelationType)
    {
        $this->ProjectRelationType = $ProjectRelationType;
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
     * @return mixed
     */
    public function getProject()
    {
        return $this->Project;
    }

    /**
     * @param mixed $Project
     */
    public function setProject($Project)
    {
        $this->Project = $Project;
    }

    /**
     * @return mixed
     */
    public function getAdminId()
    {
        return $this->AdminId;
    }

    /**
     * @param mixed $AdminId
     */
    public function setAdminId($AdminId)
    {
        $this->AdminId = $AdminId;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->Admin;
    }

    /**
     * @param mixed $Admin
     */
    public function setAdmin($Admin)
    {
        $this->Admin = $Admin;
    }
}