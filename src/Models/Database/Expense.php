<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 19.02.2016
 * Time: 19:35
 */

namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\Base\BaseProjectInfo;
use famoser\phpFrame\Core\Logging\LogHelper;

class Expense extends BaseProjectInfo
{
    const EXPENSE_CONSUMABLE = 1;
    const EXPENSE_HARDWARE = 2;
    const EXPENSE_SOFTWARE = 3;

    private $IsExternal;
    private $ExpenseType;

    private $Amount;

    public function getDatabaseArray()
    {
        $props = array(
            "IsExternal" => $this->getIsExternal(),
            "ExpenseType" => $this->getExpenseType(),
            "Amount" => $this->getAmount(),
        );
        return array_merge($props, parent::getDatabaseArray());
    }

    public function getExpenseTypeText($const)
    {
        if ($const == Expense::EXPENSE_CONSUMABLE)
            return "consumable";
        if ($const == Expense::EXPENSE_HARDWARE)
            return "hardware";
        if ($const == Expense::EXPENSE_SOFTWARE)
            return "software";

        LogHelper::getInstance()->logError("unknown const: " . $const);
        return "unknown";
    }

    public function getIdentification()
    {
        return parent::getIdentification() . " (" . $this->getExpenseTypeAsText() . ")";
    }

    public function getExpenseTypeAsText()
    {
        return $this->getExpenseTypeText($this->getExpenseType());
    }

    /**
     * @return mixed
     */
    public function getIsExternal()
    {
        return $this->IsExternal;
    }

    /**
     * @param mixed $IsExternal
     */
    public function setIsExternal($IsExternal)
    {
        $this->IsExternal = $IsExternal;
    }

    /**
     * @return mixed
     */
    public function getExpenseType()
    {
        return $this->ExpenseType;
    }

    /**
     * @param mixed $ExpenseType
     */
    public function setExpenseType($ExpenseType)
    {
        $this->ExpenseType = $ExpenseType;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param mixed $Amount
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
    }
}