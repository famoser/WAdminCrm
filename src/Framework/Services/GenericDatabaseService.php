<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 03.07.2015
 * Time: 10:01
 */

namespace famoser\phpFrame\Services;

use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\FormatHelper;
use famoser\phpFrame\Helpers\PasswordHelper;
use famoser\phpFrame\Helpers\ReflectionHelper;
use famoser\phpFrame\Models\Database\BaseDatabaseModel;
use famoser\phpFrame\Models\Database\BaseModel;
use famoser\phpFrame\Models\Services\GenericDatabaseService\TableModel;
use PDO;

class GenericDatabaseService extends DatabaseService
{
    private $tables;

    public function setup()
    {
        $objectConfigs = $this->getConfig("Objects");
        $tableConfigs = $this->getConfig("Tables");

        $objects = array();
        foreach ($objectConfigs as $objectConfig) {
            $tableModel = new TableModel();
            $res = $tableModel->setConfig($objectConfig, true);
            if ($res === true) {
                $objects[$objectConfig["ObjectName"]] = $tableModel;
            } else {
                LogHelper::getInstance()->logError("Error in " . $objectConfig["ObjectName"] . ": " . TableModel::evaluateError($res));
                return false;
            }
        }

        $this->tables = array();
        foreach ($tableConfigs as $tableConfig) {
            $tableModel = new TableModel();
            $res = $tableModel->setConfig($tableConfig);
            if ($res === true) {
                $tables[$tableConfig["ObjectName"]] = $tableModel;
            } else {
                LogHelper::getInstance()->logError("Error in " . $tableConfig["ObjectName"] . ": " . TableModel::evaluateError($res));
                return false;
            }
        }

        foreach ($this->getTables() as $table) {
            $inst = $table->getInstance();
            var_dump(ReflectionHelper::getInstance()->getInheritanceTree($inst));
        }

        return true;
    }

    /**
     * @return TableModel[]
     */
    private function getTables()
    {
        return $this->tables;
    }

    /**
     * @param BaseDatabaseModel $model
     * @param $id
     * @param boolean $addRelationships
     * @return BaseDatabaseModel
     */
    public function getById(BaseDatabaseModel $model, $id, $addRelationships = true)
    {
        return $this->getSingle($model, array("Id" => $id), $addRelationships);
    }

    /**
     * @param BaseDatabaseModel $model
     * @param null $condition
     * @param boolean $addRelationships
     * @param null $orderBy
     * @param null $additionalSql
     * @return \famoser\phpFrame\Models\Database\BaseDatabaseModel[]
     */
    public function getAll(BaseDatabaseModel $model, $condition = null, $addRelationships = true, $orderBy = null, $additionalSql = null)
    {
        $table = $this->getTableName($model);

        if ($orderBy != null)
            $orderBy = " ORDER BY " . $orderBy;

        $db = $this->getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM ' . $table . " " . $this->constructConditionSQL($condition) . $orderBy . " " . $additionalSql);
        $stmt->execute($condition);

        return $this->fetchAllToClass($stmt, $model, $addRelationships);
    }

    /**
     * @param BaseDatabaseModel $model
     * @param string $sql
     * @param array|null $preparedArray
     * @param boolean $addRelationships
     * @return \famoser\phpFrame\Models\Database\BaseDatabaseModel[]
     */
    protected function getAllWithQuery(BaseDatabaseModel $model, string $sql, array $preparedArray = null, $addRelationships = true)
    {
        $db = $this->getDatabaseConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute($preparedArray);

        return $this->fetchAllToClass($stmt, $model, $addRelationships);
    }

    /**
     * @param BaseDatabaseModel $model
     * @param null $condition
     * @param boolean $addRelationships
     * @param string $orderBy
     * @return BaseDatabaseModel
     */
    public function getSingle(BaseDatabaseModel $model, $condition = null, $addRelationships = true, $orderBy = "")
    {
        $table = $this->getTableName($model);

        if ($orderBy != "")
            $orderBy = " ORDER BY " . $orderBy;

        $db = $this->getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM ' . $table . $this->constructConditionSQL($condition) . $orderBy . " LIMIT 1");
        $stmt->execute($condition);

        return $this->fetchSingleToClass($stmt, $model, $addRelationships);
    }

    /**
     * @param BaseDatabaseModel $model
     * @param string $sql
     * @param array|null $preparedArray
     * @param boolean $addRelationships
     * @return BaseDatabaseModel
     */
    protected function getSingleWithQuery(BaseDatabaseModel $model, string $sql, $preparedArray = null, $addRelationships = true)
    {
        $db = $this->getDatabaseConnection();
        $stmt = $db->prepare($sql . " LIMIT 1");
        $stmt->execute($preparedArray);

        return $this->fetchSingleToClass($stmt, $model, $addRelationships);
    }

    /**
     * @param \PDOStatement $stmt
     * @param BaseDatabaseModel $model
     * @param boolean $addRelationships
     * @return BaseDatabaseModel[]
     */
    private function fetchAllToClass(\PDOStatement $stmt, BaseDatabaseModel $model, $addRelationships = false)
    {
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, ReflectionHelper::getInstance()->getClassName($model));
        if ($addRelationships)
            foreach ($result as $item) {
                $this->addRelationsToSingle($item);
            }
        return $result;
    }

    /**
     * @param \PDOStatement $stmt
     * @param BaseDatabaseModel $model
     * @param boolean $addRelationships
     * @return BaseDatabaseModel
     */
    private function fetchSingleToClass(\PDOStatement $stmt, BaseDatabaseModel $model, $addRelationships = false)
    {
        $result = $this->fetchAllToClass($stmt, $model, false);
        if (isset($result[0])) {
            if ($addRelationships)
                $this->addRelationsToSingle($result[0]);
            return $result[0];
        } else
            return false;
    }

    public function getPropertyByCondition(BaseDatabaseModel $model, $property, $condition = null, $orderBy = null)
    {
        $table = $this->getTableName($model);

        if ($orderBy != null)
            $orderBy = " ORDER BY " . $orderBy;
        else
            $orderBy = " ORDER BY " . $property;

        $db = $this->getDatabaseConnection();
        $stmt = $db->prepare('SELECT ' . $property . ' FROM ' . $table . $this->constructConditionSQL($condition) . $orderBy);
        $stmt->execute($condition);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC, $model);
        $resArray = array();
        foreach ($result as $res) {
            $resArray[] = $res[$property];
        }

        return $resArray;
    }

    public function create(BaseDatabaseModel $model)
    {
        $arr = $model->getDatabaseArray();
        $arr["ChangeDateTime"] = FormatHelper::getInstance()->dateTimeFromString("now");
        $arr["CreateDateTime"] = FormatHelper::getInstance()->dateTimeFromString("now");
        $arr["ChangedById"] = AuthenticationService::getInstance()->getUser()->getId();
        $arr["CreatedById"] = AuthenticationService::getInstance()->getUser()->getId();

        $table = $this->getTableName($model);

        $arr = $this->cleanUpGenericArray($arr);
        if (isset($arr["Id"])) {
            unset($arr["Id"]);
        }
        $resp = $this->createInternal($table, $arr);
        if ($resp !== false) {
            $model->setId($resp);
            return true;
        }
        return false;
    }

    public function update(BaseDatabaseModel $model, array $allowedArr = null)
    {
        $arr = $model->getDatabaseArray();
        $arr["ChangeDateTime"] = FormatHelper::getInstance()->dateTimeFromString("now");
        $arr["ChangedById"] = AuthenticationService::getInstance()->getUser()->getId();

        $table = $this->getTableName($model);

        $arr = $this->cleanUpGenericArray($arr);
        $params = $arr;
        if (is_array($allowedArr)) {
            $params = array();
            foreach ($allowedArr as $item) {
                $params[$item] = $arr[$item];
            }
        }
        if (!isset($arr["Id"]) || $arr["Id"] == 0) {
            return false;
        } else {
            return $this->updateInternal($table, $params);
        }
    }

    public function delete(BaseDatabaseModel $model)
    {
        if ($model->getId() != 0)
            return $this->deleteById($model, $model->getId());
        return true;
    }

    public function deleteById(BaseDatabaseModel $model, $id)
    {
        $table = $this->getTableName($model);
        return $this->deleteInternal($table, $id);
    }

    private function addRelationsToSingle(BaseDatabaseModel $model)
    {
        foreach ($model->getDatabaseArray() as $key => $val) {
            if (strpos($key, "Id") !== false) {
                if ($val > 0) {
                    $objectName = str_replace("Id", "", $key);
                    $fullObjectName = ReflectionHelper::getInstance()->getNamespace($model) . "\\" . $objectName;
                    $obj = new $fullObjectName();
                    $relationObj = $this->GetById($obj, $val, false);
                    if ($relationObj !== false) {
                        $secMethod = "set" . $objectName;
                        $obj->$secMethod($relationObj);
                    }
                }
            }
        }
    }

    private function createInternal($table, $arr)
    {
        $db = $this->getDatabaseConnection();
        $excludedArray = array();
        $params = $this->cleanUpGenericArray($arr);
        $stmt = $db->prepare('INSERT INTO ' . $table . ' ' . $this->constructMiddleSQL("insert", $params, $excludedArray));
        if ($stmt->execute($params))
            return $db->lastInsertId();
        return false;
    }

    private function updateInternal($table, $arr)
    {
        $db = $this->getDatabaseConnection();
        $params = $this->cleanUpGenericArray($arr);
        $excludedArray = array();
        $excludedArray[] = "Id";
        $stmt = $db->prepare('UPDATE ' . $table . ' SET ' . $this->constructMiddleSQL("update", $params, $excludedArray) . ' WHERE Id = :Id');
        return $stmt->execute($params);
    }

    private function deleteInternal($table, $id)
    {
        $db = $this->getDatabaseConnection();
        $stmt = $db->prepare('DELETE FROM ' . $table . ' WHERE Id = :Id');
        $stmt->bindParam(":Id", $id);
        return $stmt->execute();
    }

    private function constructConditionSQL($params)
    {
        if ($params == null || !is_array($params) || count($params) == 0)
            return "";

        $sql = " WHERE ";
        foreach ($params as $key => $val) {
            $sql .= $key . " = :" . $key . " AND ";
        }
        $sql = substr($sql, 0, -4);
        return $sql;
    }

    private function constructMiddleSQL($mode, $params, $excluded)
    {
        $sql = "";
        if ($mode == "update") {
            foreach ($params as $key => $val) {
                if (!in_array($key, $excluded))
                    $sql .= $key . " = :" . $key . ", ";
            }
            $sql = substr($sql, 0, -2);
        } else if ($mode == "insert") {
            $part1 = "(";
            $part2 = "VALUES (";
            foreach ($params as $key => $val) {
                if (!in_array($key, $excluded)) {
                    $part1 .= $key . ", ";
                    $part2 .= ":" . $key . ", ";
                }
            }
            $part1 = substr($part1, 0, -2);
            $part2 = substr($part2, 0, -2);

            $part1 .= ") ";
            $part2 .= ")";
            $sql = $part1 . $part2;
        }
        return $sql;
    }

    private function prepareGenericArray($params)
    {
        if (is_object($params)) {
            $properties = get_object_vars($params);
            $params = array();
            foreach ($properties as $key => $val) {
                if ($val != null && !is_object($val))
                    $params[$key] = $val;
            }
        }
        return $params;
    }

    private function cleanUpGenericArray($params, $removeNull = false)
    {
        $params = $this->prepareGenericArray($params);
        $deleteKeys = array();

        foreach ($params as $key => $val) {
            if (strpos($key, "DateTime") !== false)
                $params[$key] = FormatHelper::getInstance()->dateTimeDatabase($val);

            else if (strpos($key, "Date") !== false)
                $params[$key] = FormatHelper::getInstance()->dateDatabase($val);

            else if (strpos($key, "PasswordHash") !== false)
                $params[$key] = PasswordHelper::getInstance()->convertToPasswordHash($val);

            if ($removeNull && $params[$key] == null)
                $deleteKeys[] = $key;
        }
        foreach ($deleteKeys as $notValidKey) {
            unset($params[$notValidKey]);
        }

        return $params;
    }

    private function getTableName(BaseDatabaseModel $model)
    {
        $modelName = $table = ReflectionHelper::getInstance()->getObjectName($model);
        return $modelName;
    }
}