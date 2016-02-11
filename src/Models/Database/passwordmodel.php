<?php

namespace famoser\crm\Models\Database;
use famoser\phpFrame\Interfaces\BaseModel;
use famoser\phpFrame\Interfaces\BaseThingModel;

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
    private $Password;
    private $Notes;

    private $CustomerId;
    private $Customer;

    /**
     * @param CustomerModel $customer
     */
    public function setCustomer(CustomerModel $customer)
    {
        $this->Customer = $customer;
    }

    /**
     * @return CustomerModel
     */
    public function getCustomer()
    {
        return $this->Customer;
    }
}