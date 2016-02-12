<?php
namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\EmployeeModel;
use famoser\phpFrame\Interfaces\IModel;
use famoser\phpFrame\Models\Database\BasePersonalModel;

/**
 * Created by PhpStorm.
 * User: FlorianAlexander
 * Date: 5/18/2015
 * Time: 7:44 PM
 */
class AdminModel extends BasePersonalModel
{
    private $Email;
    private $PasswordHash;
    private $AuthHash;

    private $PersonId;
    private $Person;

    /**
     * @param PersonModel $person
     */
    public function setPerson(PersonModel $person)
    {
        $this->Person = $person;
    }

    /**
     * @return PersonModel
     */
    public function getPerson()
    {
        return $this->Person;
    }

    public function getIdentification()
    {
        if ($this->Person != null) {
            return "Admin (" . $this->Email . "), verbunden mit " . $this->getPerson()->GetIdentification();
        } else {
            return "Admin (" . $this->Email . ")";
        }
    }

    public function GetPersonalIdentification()
    {
        if ($this->Person != null) {
            return $this->getPerson()->GetPersonalIdentification();
        } else {
            return "Admin";
        }
    }

    public function getDatabaseArray()
    {
        $props = array("Email" => $this->Email, "PasswordHash" => $this->PasswordHash, "AuthHash" => $this->AuthHash, "PersonId" => $this->PersonId);
        return array_merge($props, parent::getDatabaseArray());
    }
}