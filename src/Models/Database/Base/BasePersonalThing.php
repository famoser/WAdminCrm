<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 19.02.2016
 * Time: 19:38
 */

namespace famoser\crm\Models\Database\Base;


use famoser\crm\Models\Database\Admin;
use famoser\crm\Models\Database\Person;

class BasePersonalThing extends BaseThing
{
    private $PersonId;
    private $Person;

    public function getDatabaseArray()
    {
        $props = array(
            "AdminId" => $this->getPersonId(),
        );
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