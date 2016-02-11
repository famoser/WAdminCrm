<?php
namespace famoser\crm\Models\Database;

use famoser\phpFrame\Interfaces\BasePersonalModel;

/**
 * Created by PhpStorm.
 * User: FlorianAlexander
 * Date: 5/18/2015
 * Time: 7:44 PM
 */
class CustomerModel extends BasePersonalModel
{
    private $Company;
    private $CustomerSinceDate;

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

    function GetPersonalIdentification()
    {
        if ($this->getPerson() != null) {
            return $this->getPerson()->getPersonalIdentification() . " (" . $this->Company . ")";
        }
        return $this->Company;
    }

    function GetIdentification()
    {
        return $this->getPerson()->getIdentification() . " (" . $this->Company . ")";
    }
}