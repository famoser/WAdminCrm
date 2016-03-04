<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 04.03.2016
 * Time: 18:45
 */

namespace famoser\phpFrame\Models\Services\GenericDatabaseService;


use famoser\phpFrame\Services\GenericDatabaseService;

class TableModel
{
    const ERROR_TABLE_NAME_NOT_SET = 1;
    const ERROR_OBJECT_NAME_NOT_SET = 2;
    const ERROR_PROPERTIES_NO_ARRAY = 3;

    private $tableName;
    private $objectName;
    private $properties;

    const TABLE_PROPERTY_CONST_ADD = 10000;

    public function setConfig($config, $canSkipName = false)
    {
        if (isset($config["TableName"]))
            $this->tableName = $config["TableName"];
        else {
            if (!$canSkipName)
                return TableModel::ERROR_TABLE_NAME_NOT_SET;
        }

        if (isset($config["ObjectName"]))
            $this->objectName = $config["ObjectName"];
        else {
            return TableModel::ERROR_OBJECT_NAME_NOT_SET;
        }

        if (isset($config["Properties"])) {
            if (is_array($config["Properties"])) {
                $this->properties = array();
                foreach ($config["Properties"] as $item) {
                    $prop = new InputPropertyModel();
                    $res = $prop->setConfig($item);
                    if ($res === true)
                        $this->properties[] = $prop;
                    else {
                        return $res + TableModel::TABLE_PROPERTY_CONST_ADD;
                    }
                }

                $this->objectName = $config["ObjectName"];
            } else {
                return TableModel::ERROR_PROPERTIES_NO_ARRAY;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @return string
     */
    public function getObjectName()
    {
        return $this->objectName;
    }

    /**
     * @return InputPropertyModel[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    public function getInstance()
    {
        return new $this->objectName();
    }

    public static function evaluateError($error)
    {
        if ($error > TableModel::TABLE_PROPERTY_CONST_ADD) {
            $error -= TableModel::TABLE_PROPERTY_CONST_ADD;
            return TablePropertyModel::evaluateError($error);
        } else if ($error == TableModel::ERROR_OBJECT_NAME_NOT_SET)
            return "object name not set";
        else if ($error == TableModel::ERROR_PROPERTIES_NO_ARRAY)
            return "properties are no array";
        else if ($error == TableModel::ERROR_TABLE_NAME_NOT_SET)
            return "table name not set";
        return "unknown error";
    }

    public function getCreateTableSql($driverType)
    {
        $sql = "CREATE TABLE " . $this->getTableName() . " (";
        $propSql = array();
        foreach ($this->getProperties() as $property) {
            if ($property->getType() != TablePropertyModel::TYPE_1N_RELATION)
                $propSql[] = $property->getCreateTableSql($driverType);
        }
        return $sql . implode(",", $propSql) . ")";
    }
}