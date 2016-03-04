<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 28.02.2016
 * Time: 15:45
 */

namespace famoser\crm\Models\Database\Base;


abstract class NamedPersonalDatabaseModel extends PersonalDatabaseModel
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
     * @return string
     */
    public function getPersonalIdentification()
    {
        return $this->getName();
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