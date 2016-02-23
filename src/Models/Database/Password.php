<?php

namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\Base\BaseThing;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:17
 */
class Password extends BaseThing
{
    private $Location;
    private $Username;
    private $PasswordText;
    private $Notes;

    private $CustomerId;
    private $Customer;

    private $ProjectId;
    private $Project;

    public function getDatabaseArray()
    {
        $props = array("Location" => $this->getLocation(),
            "Username" => $this->getUsername(),
            "Password" => $this->getPasswordText(),
            "Notes" => $this->getNotes(),
            "CustomerId" => $this->getCustomerId()
        );
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->Location;
    }

    /**
     * @param string $Location
     */
    public function setLocation($Location)
    {
        $this->Location = $Location;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->Username;
    }

    /**
     * @param string $Username
     */
    public function setUsername($Username)
    {
        $this->Username = $Username;
    }

    /**
     * @return string
     */
    public function getPasswordText()
    {
        return $this->PasswordText;
    }

    /**
     * @param string $PasswordText
     */
    public function setPasswordText($PasswordText)
    {
        $this->PasswordText = $PasswordText;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->Notes;
    }

    /**
     * @param string $Notes
     */
    public function setNotes($Notes)
    {
        $this->Notes = $Notes;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->CustomerId;
    }

    /**
     * @param int $CustomerId
     */
    public function setCustomerId($CustomerId)
    {
        $this->CustomerId = $CustomerId;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->Customer;
    }

    /**
     * @param Customer $Customer
     */
    public function setCustomer($Customer)
    {
        $this->Customer = $Customer;
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return $this->ProjectId;
    }

    /**
     * @param int $ProjectId
     */
    public function setProjectId($ProjectId)
    {
        $this->ProjectId = $ProjectId;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->Project;
    }

    /**
     * @param Project $Project
     */
    public function setProject($Project)
    {
        $this->Project = $Project;
    }
}