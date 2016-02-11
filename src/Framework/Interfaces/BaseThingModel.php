<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 12:44
 */

namespace famoser\phpFrame\Interfaces;


class BaseThingModel extends BaseModel
{
    protected $Name;
    protected $Description;

    public function getIdentification()
    {
        return $this->Name;
    }
}