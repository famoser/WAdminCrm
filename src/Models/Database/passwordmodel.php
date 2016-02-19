<?php

namespace famoser\crm\Models\Database;
use famoser\phpFrame\Models\Database\BaseThingModel;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 13:17
 */
class PasswordModel extends BaseThingModel
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
            "Password" => $this->getPassword(),
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
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
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
     * @return CustomerModel
     */
    public function getCustomer()
    {
        return $this->Customer;
    }

    /**
     * @param CustomerModel $Customer
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
     * @return ProjectModel
     */
    public function getProject()
    {
        return $this->Project;
    }

    /**
     * @param ProjectModel $Project
     */
    public function setProject($Project)
    {
        $this->Project = $Project;
    }
}