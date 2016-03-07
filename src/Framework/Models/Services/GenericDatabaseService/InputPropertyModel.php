<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 04.03.2016
 * Time: 21:44
 */

namespace famoser\phpFrame\Models\Services\GenericDatabaseService;


class InputPropertyModel extends TablePropertyModel
{
    private $inputType;

    public function setConfig($config)
    {
        $res = parent::setConfig($config);
        if (isset($config["InputType"])) {
            $this->inputType = $config["InputType"];
        } else {
            $this->inputType = "text";
            if ($this->getType() == TablePropertyModel::TYPE_INTEGER ||
                $this->getType() == TablePropertyModel::TYPE_DOUBLE
            )
                $this->inputType = "number";
            else if ($this->getType() == TablePropertyModel::TYPE_BOOLEAN)
                $this->inputType = "checkbox";
            else if ($this->getType() == TablePropertyModel::TYPE_DATE)
                $this->inputType = "date";
            else if ($this->getType() == TablePropertyModel::TYPE_DATETIME)
                $this->inputType = "datetime";
            else if ($this->getType() == TablePropertyModel::TYPE_TIME)
                $this->inputType = "time";
            else if ($this->getType() == TablePropertyModel::TYPE_N1_RELATION)
                $this->inputType = "select";
            else if ($this->getType() == TablePropertyModel::TYPE_1N_RELATION)
                $this->inputType = "hidden";
        }
        return $res;
    }
}