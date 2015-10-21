<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 12:09
 */
function GetActiveCustomers()
{
    $customers = GetPropertyByCondition("projects", array("IsCompletedBool" => false), "CustomerId", "StartDate");
    $customerIds = array();
    foreach ($customers as $cust) {
        if (!isset($customerIds[$cust]))
            $customerIds[$cust] = true;
    }

    $customers = array();
    foreach ($customerIds as $key => $val) {
        $customers[] = GetById("customers",$key);
    }

    return $customers;
}