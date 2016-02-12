<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 12:40
 */

namespace famoser\crm\Models\Database;



use famoser\phpFrame\Models\Database\BasePersonalModel;

class EmployeeModel extends BasePersonalModel
{
    private $PaymentPerHour;
    private $CanModifyPayment;

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
        return $this->getPerson()->getIdentification();
    }

    public function getPersonalIdentification()
    {
        return $this->getPerson()->getPersonalIdentification();
    }

    public function getDatabaseArray()
    {
        $props = array("CanModifyPayment" => $this->CanModifyPayment, "PaymentPerHour" => $this->PaymentPerHour, "PersonId" => $this->PersonId);
        return array_merge($props, parent::getDatabaseArray());
    }
}