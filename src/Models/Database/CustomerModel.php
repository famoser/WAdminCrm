<?php
namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\Base\PersonalDatabaseModel;
use famoser\phpFrame\Models\Database\BasePersonalDatabaseModel;


/**
 * Created by PhpStorm.
 * User: FlorianAlexander
 * Date: 5/18/2015
 * Time: 7:44 PM
 */
class CustomerModel extends PersonalDatabaseModel
{
    private $Company;
    private $CustomerSinceDate;

    private $Url;
    private $UrlAccessCode;

    private $Projects;

    public function getPersonalIdentification()
    {
        return $this->getPerson()->getIdentification();
    }

    public function getIdentification()
    {
        return $this->getPerson()->getIdentification() . " (" . $this->getCompany() . ")";
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
     * @return ProjectModel[]
     */
    public function getProjects()
    {
        return $this->Projects;
    }

    /**
     * @param ProjectModel[] $Projects
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

    /**
     * @return mixed
     */
    public function getUrlAccessCode()
    {
        return $this->UrlAccessCode;
    }

    /**
     * @param mixed $UrlAccessCode
     */
    public function setUrlAccessCode($UrlAccessCode)
    {
        $this->UrlAccessCode = $UrlAccessCode;
    }
}