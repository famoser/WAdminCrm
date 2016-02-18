<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 16.02.2016
 * Time: 17:56
 */

namespace famoser\phpFrame\Models\Controllers;


use famoser\phpFrame\Helpers\ReflectionHelper;
use famoser\phpFrame\Models\Database\BaseDatabaseModel;

class ControllerConfigModel
{
    private $instance;
    private $name;
    private $friendlyName;

    private $listName;
    private $listFilter;
    private $listOrderBy;
    private $listLoadRelations;

    private $crudForbiddenProperties;
    private $crudDefaultProperties;
    private $crudOverWriteProperties;

    private $oneNChildren = array();
    private $nOneParents = array();

    public function __construct(BaseDatabaseModel $model, $friendlyName)
    {
        $this->instance = $model;
        $this->name = ReflectionHelper::getInstance()->getObjectName($model);;
        $this->friendlyName = $friendlyName;
    }

    public function configureList($listName, array $listFilter, $listOrderBy = "", $listLoadRelations = true)
    {
        $this->listName = $listName;
        $this->listFilter = $listFilter;
        $this->listOrderBy = $listOrderBy;
        $this->listLoadRelations = $listLoadRelations;
    }

    public function configureCrud(array $allowedProperties, array $defaultProperties, array $overWriteProperties)
    {
        $this->crudForbiddenProperties = $allowedProperties;
        $this->crudDefaultProperties = $defaultProperties;
        $this->crudOverWriteProperties = $overWriteProperties;
    }

    public function addOneNChild(ControllerConfigModel $config)
    {
        $this->oneNChildren[] = $config;
    }

    public function addOneNParent(ControllerConfigModel $config)
    {
        $this->nOneParents[] = $config;
    }

    /**
     * @return BaseDatabaseModel
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getFriendlyName()
    {
        return $this->friendlyName;
    }

    /**
     * @return mixed
     */
    public function getListFilter()
    {
        return $this->listFilter;
    }

    /**
     * @return string
     */
    public function getListOrderBy()
    {
        return $this->listOrderBy;
    }

    /**
     * @return mixed
     */
    public function getListLoadRelations()
    {
        return $this->listLoadRelations;
    }

    /**
     * @return array
     */
    public function getCrudForbiddenProperties()
    {
        return $this->forceArrayReturn($this->crudForbiddenProperties);
    }

    /**
     * @return array
     */
    public function getCrudForbiddenPropertiesAsNullArray()
    {
        $res = array();
        foreach ($this->getCrudForbiddenProperties() as $crudForbiddenProperty) {
            $res[$crudForbiddenProperty] = null;
        }
        return $res;
    }

    /**
     * @return array
     */
    public function getCrudDefaultProperties()
    {
        return $this->forceArrayReturn($this->crudDefaultProperties);
    }

    /**
     * @param $arr
     * @return array
     */
    private function forceArrayReturn($arr)
    {
        if ($arr == null)
            return array();
        else
            return $arr;
    }

    /**
     * @return array
     */
    public function getCrudOverWriteProperties()
    {
        return $this->forceArrayReturn($this->crudOverWriteProperties);
    }

    /**
     * @return string
     */
    public function getSingleListName()
    {
        return $this->listName;
    }

    /**
     * @return string
     */
    public function getMultipleListName()
    {
        return $this->listName . "s";
    }

    /**
     * @return ControllerConfigModel[]
     */
    public function getOneNChildren()
    {
        return $this->oneNChildren;
    }

    /**
     * @param BaseDatabaseModel $instance
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
    }

    /**
     * @return ControllerConfigModel[]
     */
    public function getNOneParents()
    {
        return $this->nOneParents;
    }
}