<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 12:44
 */

namespace famoser\crm\Models\Database\Base;


use famoser\phpFrame\Models\Database\BaseDatabaseModel;

class BaseThing extends BaseDatabaseModel
{
    protected $Name;
    protected $Description;

    /**
     * @return string
     */
    public function getIdentification()
    {
        return $this->getName();
    }

    /**
     * @return array
     */
    public function getDatabaseArray()
    {
        $props = array(
            "Name" => $this->getName(),
            "Description" => $this->getDescription(),
        );
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
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