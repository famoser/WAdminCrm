<?php

/**
 * Created by PhpStorm.
 * User: FlorianAlexander
 * Date: 5/18/2015
 * Time: 7:44 PM
 */
class CustomerModel
{

    public $Id;
    public $Company;
    public $FirstName;
    public $LastName;
    public $AdressExtension;
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
    public $CustomerSinceDate;

    function GetPersonalIdentification()
    {
        if ($this->FirstName != "") {
            return $this->FirstName;
        }
        if ($this->LastName != "") {
            return $this->LastName;
        }
        return "<unknown name>";
    }

    function GetFlatIdentification()
    {
        return $this->GetIdentification();
    }

    function GetIdentification()
    {
        $str = $this->FirstName;

        if ($this->LastName != "") {
            if ($str != "")
                $str .= " ";
            $str .= $this->LastName;
        }

        if ($this->Company != "") {
            if ($str == "")
                $str .= $this->Company;
            else
                $str .= " (" . $this->Company . ")";
        }

        if ($str == "")
            return "<unknown name>";
        else
            return $str;
    }
}