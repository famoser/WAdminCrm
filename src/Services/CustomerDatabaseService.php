<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 12:36
 */

namespace famoser\crm\Services;


use famoser\crm\Models\Database\CustomerModel;
use famoser\crm\Models\Database\ProjectModel;
use famoser\phpFrame\Services\GenericDatabaseService;

class CustomerDatabaseService extends GenericDatabaseService
{
    public function getActive()
    {
        //$sql = "SELECT * FROM projects WHERE IsCompletedBool = false GROUP BY CustomerId";

        $customers = $this->getPropertyByCondition(new ProjectModel(), "CustomerId", array("IsCompletedBool" => false));
        $customerIds = array();
        foreach ($customers as $cust) {
            if (!isset($customerIds[$cust]))
                $customerIds[$cust] = true;
        }

        $customers = array();
        foreach ($customerIds as $key => $val) {
            $customers[] = $this->getById(new CustomerModel(), $key);
        }

        return $customers;
    }
}