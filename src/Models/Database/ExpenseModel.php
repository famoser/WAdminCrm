<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 19.02.2016
 * Time: 19:35
 */

namespace famoser\crm\Models\Database;

use famoser\crm\Models\Database\Base\ProjectInfoModel;
use famoser\phpFrame\Core\Logging\LogHelper;

class ExpenseModel extends ProjectInfoModel
{
    const EXPENSE_CONSUMABLE = 1;
    const EXPENSE_HARDWARE = 2;
    const EXPENSE_SOFTWARE = 3;
    const EXPENSE_EXTERNAL_SALARY = 4;

    private $ExpenseType;

    private $Amount;

    public function getExpenseTypeText($const)
    {
        if ($const == ExpenseModel::EXPENSE_CONSUMABLE)
            return "consumable";
        if ($const == ExpenseModel::EXPENSE_HARDWARE)
            return "hardware";
        if ($const == ExpenseModel::EXPENSE_SOFTWARE)
            return "software";
        if ($const == ExpenseModel::EXPENSE_EXTERNAL_SALARY)
            return "external salary";

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