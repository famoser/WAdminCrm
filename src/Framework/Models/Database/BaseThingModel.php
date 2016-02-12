<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 12:44
 */

namespace famoser\phpFrame\Models\Database;


class BaseThingModel extends BaseDatabaseModel
{
    protected $Name;
    protected $Description;

    public function getIdentification()
    {
        return $this->Name;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function getDescription()
    {
        return $this->Description;
    }
}