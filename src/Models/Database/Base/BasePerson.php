<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 14:08
 */

namespace famoser\crm\Models\Database\Base;


use famoser\crm\Models\Database\Person;
use famoser\phpFrame\Models\Database\BasePersonalModel;

abstract class BasePerson extends BasePersonalModel
{
    private $PersonId;
    private $Person;

    public function getDatabaseArray()
    {
        $props = array("PersonId" => $this->getPersonId());
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return int
     */
    public function getPersonId()
    {
        return $this->PersonId;
    }

    /**
     * @param int $PersonId
     */
    public function setPersonId($PersonId)
    {
        $this->PersonId = $PersonId;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->Person;
    }

    /**
     * @param Person $Person
     */
    public function setPerson($Person)
    {
        $this->Person = $Person;
    }
}