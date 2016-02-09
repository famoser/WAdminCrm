<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 11:02
 */

namespace famoser\phpFrame\Controllers;


use famoser\phpFrame\Framework\Views\GenericCrudView;
use famoser\phpFrame\Framework\Views\GenericView;
use famoser\phpFrame\Framework\Views\MessageView;
use famoser\phpFrame\Services\GenericDatabaseService;

class GenericController extends ControllerBase
{
    private $table = null;
    private $object = null;
    private $orderby = null;
    private $replaces = null;
    private $controllerreplaces = null;
    private $submenu = null;
    private $nrelations = null;

    public function __construct($request, $params, $files, $table, $object, $orderBy, $replaces = null, $controllerreplaces = null, $submenu = null, $nrelations = null)
    {
        parent::__construct($request, $params, $files);

        /*
        $this->table = "persons";
        $this->object = "Person";
        $this->orderby = "Nachname, Vorname";
        $this->replaces = array("add" => "edit");
        */
        $this->table = $table;
        $this->object = $object;
        $this->orderby = $orderBy;
        $this->replaces = $replaces;
        $this->controllerreplaces = $controllerreplaces;
        $this->submenu = $submenu;
        $this->nrelations = $nrelations;
    }

    function IsReplaced($targetValue)
    {
        return $this->controllerreplaces != null &&
        is_array($this->controllerreplaces) &&
        isset($this->controllerreplaces[$this->params[0]]) &&
        isset($this->controllerreplaces[$this->params[0]]) == $targetValue;
    }

    /**
     * Methode zum Anzeigen des Contents.
     *
     * @return String Content der Applikation.
     */
    public function Display($place1 = null, $place2 = null)
    {
        if (count($this->params) == 0 || $this->params[0] == "" || $this->IsReplaced("")) {
            $view = new GenericView($this->table, $this->submenu);
            $view->assign($this->table, GenericDatabaseService::getInstance()->GetAllOrderedBy($this->table, $this->orderby));
        } else {
            $view = new GenericCrudView($this->params[0], $this->replaces, $this->table);
            if ($this->params[0] == "add" || $this->IsReplaced("add")) {
                if (isset($this->request["add"]) && $this->request["add"] == "true") {
                    unset($this->request["add"]);

                    if (is_array($place2))
                    {
                        foreach ($place2 as $key => $val) {
                            $this->request[$key] = $val;
                        }
                    }

                    $res = GenericDatabaseService::getInstance()->AddOrUpdate($this->table, $this->request);
                    $obj = GenericDatabaseService::getInstance()->GetById($this->table, $res);
                    if ($obj !== false) {
                        DoLog($this->object . " was added", LOG_LEVEL_INFO);
                        $view->assign("obj", $obj);
                        if ($this->nrelations != null) {
                            foreach ($this->nrelations as $relation) {
                                $view->assign($relation["table"], GenericDatabaseService::getInstance()->GetAllOrderedBy($relation["table"], $relation["orderby"]));
                            }
                        }
                        $view->changeMode("edit");
                    } else {
                        $view = new MessageView($this->object . " could not be added", LOG_LEVEL_SYSTEM_ERROR);
                    }
                } else {
                    $view->assign("obj", $place1);
                    if ($this->nrelations != null) {
                        foreach ($this->nrelations as $relation) {
                            $view->assign($relation["table"], GenericDatabaseService::getInstance()->GetAllOrderedBy($relation["table"], $relation["orderby"]));
                        }
                    }
                }
            } else if (($this->params[0] == "edit" || $this->IsReplaced("edit")) && isset($this->params[1]) && is_numeric($this->params[1])) {
                if (isset($this->request["edit"]) && $this->request["edit"] == "true") {
                    unset($this->request["edit"]);

                    $this->request["Id"] = $this->params[1];
                    $res = GenericDatabaseService::getInstance()->AddOrUpdate($this->table, $this->request);
                    if ($res)
                        DoLog($this->object . " was updated", LOG_LEVEL_INFO);
                    else
                        DoLog($this->object . " could not be updated", LOG_LEVEL_SYSTEM_ERROR);
                }

                $obj = GenericDatabaseService::getInstance()->GetById($this->table, $this->params[1]);
                if ($obj !== false) {
                    $view->assign("obj", $obj);

                    if ($this->nrelations != null) {
                        foreach ($this->nrelations as $relation) {
                            $view->assign($relation["table"], GenericDatabaseService::getInstance()->GetAllOrderedBy($relation["table"], $relation["orderby"]));
                        }
                    }
                } else {
                    $view = new MessageView($this->object . " could not be found", LOG_LEVEL_SYSTEM_ERROR);
                }
            } else if (($this->params[0] == "delete" || $this->IsReplaced("edit")) && isset($this->params[1]) && is_numeric($this->params[1])) {
                if (isset($this->request["delete"]) && $this->request["delete"] == "true") {


                    $res = GenericDatabaseService::getInstance()->DeleteById($this->table, $this->params[1]);
                    if ($res) {
                        $view = new MessageView($this->object . " was deleted", LOG_LEVEL_INFO);
                    } else
                        $view = new MessageView($this->object . " could not be deleted", LOG_LEVEL_SYSTEM_ERROR);
                }
                $obj = GenericDatabaseService::getInstance()->GetById($this->table, $this->params[1]);
                if ($obj !== false) {
                    $view->assign("obj", $obj);
                } else {
                    $view = new MessageView($this->object . " could not be found", LOG_LEVEL_SYSTEM_ERROR);
                }
            } else {
                $view = $this->NotFound();
            }
        }

        return $view->loadTemplate();
    }
}