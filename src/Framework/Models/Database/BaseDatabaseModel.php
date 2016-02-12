<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 18:37
 */

namespace famoser\phpFrame\Models\Database;


use famoser\phpFrame\Interfaces\Models\IDatabaseModel;

abstract class BaseDatabaseModel extends BaseModel implements IDatabaseModel
{
    protected $Id;

    public function getId()
    {
        return $this->Id;
    }

    public function setId($id)
    {
        $this->Id = $id;
    }

    public function getDatabaseArray()
    {
        return array($this->getId());
    }
}