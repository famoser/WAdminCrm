<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 12:34
 */

namespace famoser\crm\Models\Database;



use famoser\phpFrame\Models\Database\BasePersonalModel;

class PersonModel extends BasePersonalModel
{
    public $FirstName;
    public $LastName;
    public $AddressExtension;
    public $Street;
    public $Land;
    public $ZipCode;
    public $Place;
    public $TelPrivat;
    public $TelBusiness;
    public $Mobile;
    public $Email;
    public $BirthDate;
    public $Description;

    public function getIdentification()
    {
        return $this->getFirstName() . " " . $this->getLastName();
    }

    public function getPersonalIdentification()
    {
        return $this->getFirstName();
    }

    public function getDatabaseArray()
    {
        $props = array("FirstName" => $this->getFirstName(),
            "LastName" => $this->getLastName(),
            "AddressExtension" => $this->getAddressExtension(),
            "Street" => $this->getStreet(),
            "Land" => $this->getLand(),
            "ZipCode" => $this->getZipCode(),
            "Place" => $this->getPlace(),
            "TelPrivat" => $this->getTelPrivat(),
            "TelBusiness" => $this->getTelBusiness(),
            "Mobile" => $this->getMobile(),
            "Email" => $this->getEmail(),
            "BirthDate" => $this->getBirthDate(),
            "Description" => $this->getDescription(),
        );
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param string $FirstName
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @param string $LastName
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;
    }

    /**
     * @return string
     */
    public function getAddressExtension()
    {
        return $this->AddressExtension;
    }

    /**
     * @param string $AddressExtension
     */
    public function setAddressExtension($AddressExtension)
    {
        $this->AddressExtension = $AddressExtension;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->Street;
    }

    /**
     * @param string $Street
     */
    public function setStreet($Street)
    {
        $this->Street = $Street;
    }

    /**
     * @return string
     */
    public function getLand()
    {
        return $this->Land;
    }

    /**
     * @param string $Land
     */
    public function setLand($Land)
    {
        $this->Land = $Land;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->ZipCode;
    }

    /**
     * @param string $ZipCode
     */
    public function setZipCode($ZipCode)
    {
        $this->ZipCode = $ZipCode;
    }

    /**
     * @return string
     */
    public function getPlace()
    {
        return $this->Place;
    }

    /**
     * @param string $Place
     */
    public function setPlace($Place)
    {
        $this->Place = $Place;
    }

    /**
     * @return string
     */
    public function getTelPrivat()
    {
        return $this->TelPrivat;
    }

    /**
     * @param string $TelPrivat
     */
    public function setTelPrivat($TelPrivat)
    {
        $this->TelPrivat = $TelPrivat;
    }

    /**
     * @return string
     */
    public function getTelBusiness()
    {
        return $this->TelBusiness;
    }

    /**
     * @param string $TelBusiness
     */
    public function setTelBusiness($TelBusiness)
    {
        $this->TelBusiness = $TelBusiness;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->Mobile;
    }

    /**
     * @param string $Mobile
     */
    public function setMobile($Mobile)
    {
        $this->Mobile = $Mobile;
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
    public function getBirthDate()
    {
        return $this->BirthDate;
    }

    /**
     * @param string $BirthDate
     */
    public function setBirthDate($BirthDate)
    {
        $this->BirthDate = $BirthDate;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }
}