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
        return $this->FirstName . " " . $this->LastName;
    }

    public function getPersonalIdentification()
    {
        return $this->FirstName;
    }

    public function getDatabaseArray()
    {
        $props = array("FirstName" => $this->FirstName,
            "LastName" => $this->LastName,
            "AddressExtension" => $this->AddressExtension,
            "Street" => $this->Street,
            "Land" => $this->Land,
            "ZipCode" => $this->ZipCode,
            "Place" => $this->Place,
            "TelPrivat" => $this->TelPrivat,
            "TelBusiness" => $this->TelBusiness,
            "Mobile" => $this->Mobile,
            "Email" => $this->Email,
            "BirthDate" => $this->BirthDate,
            "Description" => $this->Description,
        );
        return array_merge($props, parent::getDatabaseArray());
    }
}