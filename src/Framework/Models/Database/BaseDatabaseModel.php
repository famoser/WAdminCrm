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
    private $ChangedById;
    private $CreatedById;
    private $ChangeDateTime;
    private $CreateDateTime;

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
}