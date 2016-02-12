<?php
namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\Base\BasePersonModel;

/**
 * Created by PhpStorm.
 * User: FlorianAlexander
 * Date: 5/18/2015
 * Time: 7:44 PM
 */
class AdminModel extends BasePersonModel
{
    private $Email;
    private $PasswordHash;
    private $AuthHash;

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
        $props = array("Email" => $this->getEmail(), "PasswordHash" => $this->getPasswordHash(), "AuthHash" => $this->getAuthHash());
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
     * @return string
     */
    public function getPasswordHash()
    {
        return $this->PasswordHash;
    }

    /**
     * @param string $PasswordHash
     */
    public function setPasswordHash($PasswordHash)
    {
        $this->PasswordHash = $PasswordHash;
    }

    /**
     * @return string
     */
    public function getAuthHash()
    {
        return $this->AuthHash;
    }

    /**
     * @param string $AuthHash
     */
    public function setAuthHash($AuthHash)
    {
        $this->AuthHash = $AuthHash;
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