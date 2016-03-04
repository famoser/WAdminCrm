<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 11.02.2016
 * Time: 12:40
 */

namespace famoser\crm\Models\Database;


use famoser\crm\Models\Database\Base\PersonalDatabaseModel;

class EmployeeDatabaseModel extends PersonalDatabaseModel
{
    private $DefaultPaymentPerHour;

    /**
     * @return string
     */
    public function getDefaultPaymentPerHour()
    {
        return $this->DefaultPaymentPerHour;
    }

    /**
     * @param string $DefaultPaymentPerHour
     */
    public function setDefaultPaymentPerHour($DefaultPaymentPerHour)
    {
        $this->DefaultPaymentPerHour = $DefaultPaymentPerHour;
    }
}