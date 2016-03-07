<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 18:37
 */

namespace famoser\phpFrame\Models\Database;


use famoser\phpFrame\Interfaces\Models\IDatabaseModel;
use famoser\phpFrame\Models\BaseModel;

abstract class BaseDatabaseModel extends BaseModel implements IDatabaseModel
{
    private $Id;
    private $CreatedById;
    private $CreateDateTime;
    private $ChangedById;
    private $ChangeDateTime;

    private $CreatedBy;
    private $ChangedBy;

    public function getId()
    {
        return $this->Id;
    }

    public function setId($id)
    {
        $this->Id = $id;
    }

    /**
     * @return int
     */
    public function getChangedById()
    {
        return $this->ChangedById;
    }

    /**
     * @return string
     */
    public function getChangeDateTime()
    {
        return $this->ChangeDateTime;
    }

    /**
     * @return string
     */
    public function getCreateDateTime()
    {
        return $this->CreateDateTime;
    }

    /**
     * @return mixed
     */
    public function getCreatedById()
    {
        return $this->CreatedById;
    }

    /**
     * @return LoginDatabaseModel
     */
    public function getCreatedBy()
    {
        return $this->CreatedBy;
    }

    /**
     * @param LoginDatabaseModel $CreatedBy
     */
    public function setCreatedBy($CreatedBy)
    {
        $this->CreatedBy = $CreatedBy;
    }

    /**
     * @return LoginDatabaseModel
     */
    public function getChangedBy()
    {
        return $this->ChangedBy;
    }

    /**
     * @param LoginDatabaseModel $ChangedBy
     */
    public function setChangedBy($ChangedBy)
    {
        $this->ChangedBy = $ChangedBy;
    }
}