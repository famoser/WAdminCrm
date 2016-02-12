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
        $props = array("CanModifyPayment" => $this->getCanModifyPayment(), "PaymentPerHour" => $this->getPaymentPerHour(), "PersonId" => $this->getPersonId());
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return string
     */
    public function getPaymentPerHour()
    {
        return $this->PaymentPerHour;
    }

    /**
     * @param string $PaymentPerHour
     */
    public function setPaymentPerHour($PaymentPerHour)
    {
        $this->PaymentPerHour = $PaymentPerHour;
    }

    /**
     * @return bool
     */
    public function getCanModifyPayment()
    {
        return $this->CanModifyPayment;
    }

    /**
     * @param bool $CanModifyPayment
     */
    public function setCanModifyPayment($CanModifyPayment)
    {
        $this->CanModifyPayment = $CanModifyPayment;
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