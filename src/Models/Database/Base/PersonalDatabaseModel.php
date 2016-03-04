<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 14:08
 */

namespace famoser\crm\Models\Database\Base;


use famoser\crm\Models\Database\PersonModel;
use famoser\phpFrame\Models\Database\BasePersonalDatabaseModel;

abstract class PersonalDatabaseModel extends BasePersonalDatabaseModel
{
    private $PersonId;
    private $Person;

    public function getIdentification()
    {
        return $this->getPerson()->getIdentification();
    }

    public function getPersonalIdentification()
    {
        return $this->getPerson()->getPersonalIdentification();
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
     * @return PersonModel
     */
    public function getPerson()
    {
        return $this->Person;
    }

    /**
     * @param PersonModel $Person
     */
    public function setPerson($Person)
    {
        $this->Person = $Person;
    }
}