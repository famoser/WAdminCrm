<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 19.02.2016
 * Time: 20:13
 */

namespace famoser\crm\Models\Database;


use famoser\crm\Models\Database\Base\PersonalDatabaseModel;
use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Models\Database\BaseDatabaseModel;

class ProjectPersonRelationModel extends PersonalDatabaseModel
{
    const PROJECT_MANAGER = 1;
    const PROJECT_PARTICIPANT = 2;
    const PROJECT_VIEWER = 3;

    private $ProjectPersonRelationType;

    private $ProjectId;
    private $Project;

    public function getIdentification()
    {
        return $this->getProjectRelationTypeAsText();
    }

    public function getProjectRelationTypeText($const)
    {
        if ($const == ProjectPersonRelationModel::PROJECT_MANAGER)
            return "project manager";
        if ($const == ProjectPersonRelationModel::PROJECT_PARTICIPANT)
            return "project participant";
        if ($const == ProjectPersonRelationModel::PROJECT_VIEWER)
            return "project viewer";

        LogHelper::getInstance()->logError("unknown const: " . $const);
        return "unknown";
    }

    public function getProjectRelationTypeAsText()
    {
        return $this->getProjectRelationTypeText($this->getProjectPersonRelationType());
    }

    /**
     * @return mixed
     */
    public function getProjectPersonRelationType()
    {
        return $this->ProjectPersonRelationType;
    }

    /**
     * @param mixed $ProjectPersonRelationType
     */
    public function setProjectPersonRelationType($ProjectPersonRelationType)
    {
        $this->ProjectPersonRelationType = $ProjectPersonRelationType;
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