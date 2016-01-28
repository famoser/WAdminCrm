<?php

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 16:03
 */
class ProceduresController extends ControllerBase
{
    private $request = null;
    private $params = null;

    private $genericController = null;

    /**
     * Konstruktor, erstellet den Controllers.
     *
     * @param Array $request Array aus $_GET & $_POST.
     */
    public function __construct($request, $requestFiles, $params)
    {
        $this->request = $request;
        $this->params = $params;
        $this->genericController = new GenericController($this->request, $this->params, "procedures", "procedure", "StartDateTime DESC", array("add" => "edit"), null, $this->getMenu(), $this->getNRelations());
    }

    function getMenu()
    {
        $res = array();
        return $res;
    }

    function getNRelations()
    {
        $res = array();
        $menuItem = array();
        $menuItem["table"] = "milestones";
        $menuItem["orderby"] = "Name";
        $res[] = $menuItem;
        return $res;
    }

    public function Display()
    {
        $user = GetActiveUser();
        $view = $this->NotFound();
        if (count($this->params) == 0) {
            $view = new GenericView("procedures", $this->getMenu());$milestones = GetAllByCondition("milestones", array("IsCompletedBool" => false), true, "StartDate");
            foreach ($milestones as $milestone) {
                $milestone->Procedures = GetAllByCondition("procedures", array("MilestoneId" => $milestone->Id), false, "StartDateTime");
            }
            $view->assign("milestones", $milestones);
        } else if (count($this->params) > 1 && $this->params[0] == "bymilestone" && is_numeric($this->params[1])) {
            $miles = GetById("milestones", $this->params[1]);
            if ($miles != null) {
                $miles->Procedures =  GetAllByCondition("procedures", array("MilestoneId" => $this->params[1]), true, "StartDateTime");
                $view = new GenericView("procedures", $this->getMenu(), "procedures of " . $miles->GetIdentification());
                $view->assign("milestones", array($miles));
            } else {
                $view = new GenericView("procedures", $this->getMenu());
                DoLog("milestone not found", LOG_LEVEL_USER_ERROR);
                $view->assign("milestones", array());
            }
        } else {
            if ($this->params[0] == "add") {
                $pm = new ProcedureModel();
                $pm->EndDateTime = date(DATETIME_FORMAT_DATABASE, strtotime("now"));
                if (isset($this->params[1]) && is_numeric($this->params[1])) {
                    $milest = GetById("milestones", $this->params[1]);
                    if ($milest != null) {
                        $pm->MilestoneId = $milest->Id;
                        $procedurebefore = GetSingleByCondition("procedures", array("MilestoneId" => $milest->Id),false,"EndDateTime DESC");
                        if ($procedurebefore != null &&  strtotime($procedurebefore->EndDateTime) > strtotime("now - 5 hours"))
                            $pm->StartDateTime = $procedurebefore->EndDateTime;
                        else
                            $pm->StartDateTime = date(DATETIME_FORMAT_DATABASE, strtotime("now - 1 hour"));
                        $pm->PaymentPerHour = $milest->PaymentPerHour;
                    }
                    return $this->genericController->Display($pm);
                }
                return $this->genericController->Display($pm, array("AdminId" => $user->Id));
            } else if ($this->params[0] == "edit" && isset($this->params[1]) && is_numeric($this->params[1])) {
                $prop = GetPropertyByCondition("procedures", array("AdminId" => $user->Id, "Id" => $this->params[1]), "Id");
                if (count($prop) == 1)
                    return $this->genericController->Display(null);
                else
                    return $this->AccessDenied();
            } else if ($this->params[0] == "delete" && isset($this->params[1]) && is_numeric($this->params[1])) {
                $prop = GetPropertyByCondition("procedures", array("AdminId" => $user->Id, "Id" => $this->params[1]), "Id");
                if (count($prop) == 1)
                    return $this->genericController->Display();
                else
                    return $this->AccessDenied();
            }
        }

        return $view->loadTemplate();
    }
}