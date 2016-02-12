<?php
namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\Base\BasePersonModel;
use famoser\phpFrame\Models\Database\LoginModel;

/**
 * Created by PhpStorm.
 * User: FlorianAlexander
 * Date: 5/18/2015
 * Time: 7:44 PM
 */
class AdminModel extends LoginModel
{
    private $Email;

    private $PersonId;
    private $Person;

    public function getIdentification()
    {
        if ($this->getPerson() != null) {
            return "Admin (" . $this->getEmail() . "), verbunden mit " . $this->getPerson()->GetIdentification();
        } else {
            return "Admin (" . $this->getEmail() . ")";
        }
    }

    public function getPersonalIdentification()
    {
        if ($this->getPerson() != null) {
            return $this->getPerson()->GetPersonalIdentification();
        } else {
            return "Admin";
        }
    }

    public function getDatabaseArray()
    {
        $props = array("Email" => $this->getEmail(), "PersonId" => $this->getPersonId());
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param string $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
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