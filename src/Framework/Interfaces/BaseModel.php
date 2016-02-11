<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 12:21
 */

namespace famoser\phpFrame\Interfaces;


abstract class BaseModel implements IModel
{
    protected $Id;

    public function getId()
    {
        return $this->Id;
    }
}