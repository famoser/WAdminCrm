<?php
namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\Base\BasePerson;
use famoser\phpFrame\Models\Database\BasePersonalModel;


/**
 * Created by PhpStorm.
 * User: FlorianAlexander
 * Date: 5/18/2015
 * Time: 7:44 PM
 */
class Customer extends BasePerson
{
    private $Company;
    private $CustomerSinceDate;

    private $Url;

    private $Projects;

    public function getPersonalIdentification()
    {
        if ($this->getPerson() != null) {
            return $this->getPerson()->getPersonalIdentification() . " (" . $this->getCompany() . ")";
        }
        return $this->getCompany();
    }

    public function getIdentification()
    {
        return $this->getPerson()->getIdentification() . " (" . $this->getCompany() . ")";
    }

    public function getDatabaseArray()
    {
        $props = array("Company" => $this->getCustomerSinceDate(), "CustomerSinceDate" => $this->getCustomerSinceDate());
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->Company;
    }

    /**
     * @param mixed $Company
     */
    public function setCompany($Company)
    {
        $this->Company = $Company;
    }

    /**
     * @return string
     */
    public function getCustomerSinceDate()
    {
        return $this->CustomerSinceDate;
    }

    /**
     * @param string $CustomerSinceDate
     */
    public function setCustomerSinceDate($CustomerSinceDate)
    {
        $this->CustomerSinceDate = $CustomerSinceDate;
    }

    /**
     * @return Project[]
     */
    public function getProjects()
    {
        return $this->Projects;
    }

    /**
     * @param Project[] $Projects
     */
    public function setProjects($Projects)
    {
        $this->Projects = $Projects;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->Url;
    }

    /**
     * @param mixed $Url
     */
    public function setUrl($Url)
    {
        $this->Url = $Url;
    }
}