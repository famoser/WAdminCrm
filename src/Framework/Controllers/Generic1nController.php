<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 11:02
 */

namespace famoser\phpFrame\Controllers;


use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\ReflectionHelper;
use famoser\phpFrame\Models\Database\BaseDatabaseModel;
use famoser\phpFrame\Models\Database\BaseModel;
use famoser\phpFrame\Models\View\MenuItem;
use famoser\phpFrame\Services\DatabaseService;
use famoser\phpFrame\Services\GenericDatabaseService;
use famoser\phpFrame\Views\GenericCrudView;
use famoser\phpFrame\Views\GenericView;

class Generic1nController extends MenuController
{
    private $objectInstance = null;
    private $crudReplaces = null;
    private $nRelationInstances = null;
    private $controllerName;
    private $friendlyObjectName;

    //same values in GenericCrudView!
    const CRUD_CREATE = 1;
    const CRUD_READ = 2;
    const CRUD_UPDATE = 3;
    const CRUD_DELETE = 4;

    /**
     * GenericController constructor.
     * @param $request
     * @param $params
     * @param $files
     * @param BaseDatabaseModel $objectInstance
     * @param array|null example : array(Generic1nController::CRUD_CREATE => Generic1nController::CRUD_READ)
     * @param array|null example : array("admins" => array(new AdminModel(), array("IsCompleted" => true), "Name"))
     */
    public function __construct($request, $params, $files, BaseDatabaseModel $objectInstance, array $crudReplaces = null, array $nRelationInstances = null)
    {
        parent::__construct($request, $params, $files);

        $this->objectInstance = $objectInstance;
        $this->crudReplaces = $crudReplaces;
        $this->nRelationInstances = $nRelationInstances;

        $this->controllerName = ReflectionHelper::getInstance()->removeNamespace($this);
        $this->friendlyObjectName = str_replace("sController", "", $this->controllerName);
    }

    /**
     * @return BaseDatabaseModel
     */
    protected function getObjectInstance()
    {
        return $this->objectInstance;
    }

    /**
     * @param BaseDatabaseModel $instance
     */
    protected function setObjectInstance(BaseDatabaseModel $instance)
    {
        $this->objectInstance = $instance;
    }

    /**
     * @param null $params if null, controller will use params
     * @param null $place1
     * list: condition array("Green"=> true)
     * add (form): overWriteValues array("Id"=> 2)
     * add (no form): additional View Props array("wat"=> "aww jizz")
     * update (form): overWriteValues array("Id"=> 2)
     * update (no form): additional View Props array("wat"=> "aww jizz")
     * @param null $place2
     * list: orderBy LongName, LastName
     * add (form): removeValues array("PersonId",""LongShots")
     * add (no form): (empty)
     * update (form): removeValues array("PersonId",""LongShots")
     * update (no form): (empty)
     * @param null $place3
     * read: additional View props array("wat"=> "aww jizz")
     * @return mixed|string
     */
    public function Display($params = null, $place1 = null, $place2 = null, $place3 = null)
    {
        if ($params = null)
            $params = $this->params;

        if (count($params) == 0 || $params[0] == "") {
            $view = new GenericView($this->controllerName);

            //add $place3 props
            if (is_array($place3)) {
                foreach ($place3 as $key => $val) {
                    $view->assign($key, $val);
                }
            }

            $view->assign("models", GenericDatabaseService::getInstance()->getAll($this->getObjectInstance(), $place1, true, $place2));
        } else {
            if ($params[0] == "add") {
                if (isset($this->request["add"]) && $this->request["add"] == "true") {
                    $req = $this->request;

                    //remove Id & Add
                    unset($req["add"]);
                    if (isset($req["Id"]))
                        unset($req["Id"]);

                    //add defaults
                    if (is_array($place1)) {
                        foreach ($place1 as $key => $val) {
                            $req[$key] = $val;
                        }
                    }

                    //remove additional
                    if (is_array($place2)) {
                        foreach ($place2 as $item) {
                            if (isset($req[$item]))
                                unset($req[$item]);
                        }
                    }

                    //fill object
                    ReflectionHelper::getInstance()->writeFromPostArrayToObjectProperties($req, $this->getObjectInstance());

                    //to Database!
                    $res = GenericDatabaseService::getInstance()->create($this->getObjectInstance());

                    if ($res !== false) {
                        LogHelper::getInstance()->logUserInfo($this->friendlyObjectName . " was added");
                        $this->exitWithControllerRedirect("update/" . $this->getObjectInstance()->getId());
                    } else {
                        LogHelper::getInstance()->logError($this->friendlyObjectName . " could not be added");
                    }
                }

                $view = new GenericCrudView($this->controllerName, $this->getFilenameFromMode($this->getMode(Generic1nController::CRUD_CREATE)));
                $view->assign("model", $this->getObjectInstance());

                //add relations
                if (is_array($this->nRelationInstances)) {
                    foreach ($this->nRelationInstances as $name => $config) {
                        $view->assign($name, GenericDatabaseService::getInstance()->getAll($config[0], $config[1], false, $config[2]));
                    }
                }

                //add place1 props
                if (is_array($place1)) {
                    foreach ($place1 as $key => $val) {
                        $view->assign($key, $val);
                    }
                }

                return $this->returnView($view);
            } else if ($params[0] == "read" && isset($params[1]) && is_numeric($params[1])) {
                $obj = GenericDatabaseService::getInstance()->getById($this->getObjectInstance(), $params[1]);
                if ($obj !== false) {
                    $this->setObjectInstance($obj);

                    $view = new GenericCrudView($this->controllerName, $this->getFilenameFromMode($this->getMode(Generic1nController::CRUD_READ)));
                    $view->assign("model", $this->getObjectInstance());

                    //add relations
                    if (is_array($this->nRelationInstances)) {
                        foreach ($this->nRelationInstances as $name => $config) {
                            $view->assign($name, GenericDatabaseService::getInstance()->getAll($config[0], $config[1], false, $config[2]));
                        }
                    }

                    //add place1 props
                    if (is_array($place1)) {
                        foreach ($place1 as $key => $val) {
                            $view->assign($key, $val);
                        }
                    }

                    return $this->returnView($view);
                } else {
                    return $this->returnFailure(ControllerBase::FAILURE_NOT_FOUND);
                }
            } else if ($params[0] == "update" && isset($params[1]) && is_numeric($params[1])) {
                if (isset($this->request["update"]) && $this->request["update"] == "true") {
                    $req = $this->request;

                    unset($req["update"]);
                    $req["Id"] = $params[1];

                    //add defaults
                    if (is_array($place1)) {
                        foreach ($place1 as $key => $val) {
                            $req[$key] = $val;
                        }
                    }

                    //remove additional
                    if (is_array($place2)) {
                        foreach ($place2 as $item) {
                            if (isset($req[$item]))
                                unset($req[$item]);
                        }
                    }

                    //fill object
                    ReflectionHelper::getInstance()->writeFromPostArrayToObjectProperties($req, $this->getObjectInstance());

                    //to Database!
                    $res = GenericDatabaseService::getInstance()->update($this->getObjectInstance());

                    if ($res !== false) {
                        LogHelper::getInstance()->logUserInfo($this->friendlyObjectName . " was updated");
                    } else {
                        LogHelper::getInstance()->logError($this->friendlyObjectName . " could not be updated");
                    }
                }

                $obj = GenericDatabaseService::getInstance()->getById($this->getObjectInstance(), $params[1]);
                if ($obj !== false) {
                    $this->setObjectInstance($obj);

                    $view = new GenericCrudView($this->controllerName, $this->getFilenameFromMode($this->getMode(Generic1nController::CRUD_UPDATE)));
                    $view->assign("model", $this->getObjectInstance());

                    //add relations
                    if (is_array($this->nRelationInstances)) {
                        foreach ($this->nRelationInstances as $name => $config) {
                            $view->assign($name, GenericDatabaseService::getInstance()->getAll($config[0], $config[1], false, $config[2]));
                        }
                    }

                    //add place1 props
                    if (is_array($place1)) {
                        foreach ($place1 as $key => $val) {
                            $view->assign($key, $val);
                        }
                    }

                    return $this->returnView($view);
                } else {
                    return $this->returnFailure(ControllerBase::FAILURE_NOT_FOUND);
                }
            } else if ($params[0] == "delete" && isset($params[1]) && is_numeric($params[1])) {
                if (isset($this->request["delete"]) && $this->request["delete"] == "true") {

                    $res = GenericDatabaseService::getInstance()->deleteById($this->getObjectInstance(), $params[1]);
                    if ($res) {
                        return $this->returnSuccess(ControllerBase::SUCCESS_DELETED, $this->friendlyObjectName . " was deleted");
                    } else {
                        LogHelper::getInstance()->logError("unable to delete " . $this->friendlyObjectName);
                    }
                }
                $obj = GenericDatabaseService::getInstance()->getById($this->getObjectInstance(), $params[1]);
                if ($obj !== false) {
                    $this->setObjectInstance($obj);

                    $view = new GenericCrudView($this->controllerName, $this->getFilenameFromMode($this->getMode(Generic1nController::CRUD_DELETE)));
                    $view->assign("model", $this->getObjectInstance());

                    //add relations
                    if (is_array($this->nRelationInstances)) {
                        foreach ($this->nRelationInstances as $name => $config) {
                            $view->assign($name, GenericDatabaseService::getInstance()->getAll($config[0], $config[1], false, $config[2]));
                        }
                    }

                    //add place1 props
                    if (is_array($place1)) {
                        foreach ($place1 as $key => $val) {
                            $view->assign($key, $val);
                        }
                    }

                    return $this->returnView($view);
                } else {
                    return $this->returnFailure(ControllerBase::FAILURE_NOT_FOUND);
                }
            } else {
                return $this->returnFailure(ControllerBase::FAILURE_NOT_FOUND);
            }
        }

        return $view->loadTemplate();
    }

    public function DisplayExtended($displayCondition, $orderBy, $parentModel, $parentName)
    {
        if (count($this->params) == 0) {
            return $this->Display(array(), $displayCondition, $orderBy);
        } else {
            if (count($this->params) > 1 && is_numeric($this->params[1])) {
                if ($this->params[0] == "by" . strtolower($parentName)) {
                    $customer = GenericDatabaseService::getInstance()->getById($parentModel, $this->params[1]);
                    if ($customer != null) {
                        return $this->Display(array(), array($parentName."Id" => $customer->getId()), $orderBy);
                    } else {
                        return $this->returnFailure(ControllerBase::FAILURE_NOT_FOUND);
                    }
                } else {
                    if ($this->params[0] == "add") {
                        $model = $this->getObjectInstance();
                        $customer = GenericDatabaseService::getInstance()->getById($parentModel, $this->params[1]);
                        if ($customer != null && $customer != false) {
                            $idMethod = "set".$parentName."Id";
                            $model->$idMethod($this->params[1]);
                            $modelMethod = "set".$parentName;
                            $model->$modelMethod($customer);
                        }
                    }
                }
            }
        }

        return $this->Display();
    }

    private function getMode($mode)
    {
        if ($this->crudReplaces != null && is_array($this->crudReplaces) && isset($this->crudReplaces[$mode]))
            return $this->crudReplaces[$mode];
        else
            return $mode;
    }

    private function getFilenameFromMode($mode)
    {
        if ($mode == Generic1nController::CRUD_CREATE)
            return "create";
        else if ($mode == Generic1nController::CRUD_READ)
            return "read";
        else if ($mode == Generic1nController::CRUD_UPDATE)
            return "update";
        else if ($mode == Generic1nController::CRUD_DELETE)
            return "delete";
        else
            LogHelper::getInstance()->logFatal("Invalid crud action! Please use one of the constants in GenericController");
        return "";
    }
}