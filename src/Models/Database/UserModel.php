<?php
namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\Base\PersonalDatabaseModel;
use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Models\Database\LoginDatabaseModel;

/**
 * Created by PhpStorm.
 * User: FlorianAlexander
 * Date: 5/18/2015
 * Time: 7:44 PM
 */
class UserModel extends LoginDatabaseModel
{
    const ROLE_MANAGER = 1;
    const ROLE_EMPLOYEE = 2;

    private $RoleType;

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

    public function getRoleTypeText($const)
    {
        if ($const == UserModel::ROLE_EMPLOYEE)
            return "employee";
        if ($const == UserModel::ROLE_MANAGER)
            return "manager";

        LogHelper::getInstance()->logError("unknown const: " . $const);
        return "unknown";
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

    /**
     * @return mixed
     */
    public function getRoleType()
    {
        return $this->RoleType;
    }

    /**
     * @param mixed $RoleType
     */
    public function setRoleType($RoleType)
    {
        $this->RoleType = $RoleType;
    }
}