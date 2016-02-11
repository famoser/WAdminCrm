<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 12:40
 */

namespace famoser\crm\Models\Database;


use famoser\phpFrame\Interfaces\BasePersonalModel;

class EmployeeModel extends BasePersonalModel
{
    private $PaymentPerHour;
    private $canModifyPayment;

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
}