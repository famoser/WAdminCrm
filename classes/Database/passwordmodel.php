<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:17
 */
class PasswordModel
{
    public $Id;
    public $CustomerId;
    public $Name;
    public $Description;
    public $Location;
    public $Username;
    public $Password;
    public $Notes;

    public $Customer;

    function GetIdentification()
    {
        return $this->Name;
    }
}