<?php
namespace famoser\crm\Controllers;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 16:03
 */
class MilestonesController extends ControllerBase
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
        $this->genericController = new GenericController($this->request, $this->params, "milestones", "milestone", "StartDate", array("add" => "edit"), null, $this->getMenu(), $this->getNRelations());
    }

    function getMenu()
    {
        $res = array();
        $menuItem = array();
        $menuItem["href"] = "";
        $menuItem["content"] = "active";
        $res[] = $menuItem;
        $menuItem2 = array();
        $menuItem2["href"] = "all";
        $menuItem2["content"] = "all";
        $res[] = $menuItem2;
        return $res;
    }

    function getNRelations()
    {
        $res = array();
        $menuItem = array();
        $menuItem["table"] = "projects";
        $menuItem["orderby"] = "Name";
        $res[] = $menuItem;
        return $res;
    }

    /**
     * Methode zum Anzeigen des Contents.
     *
     * @return String Content der Applikation.
     */
    public function Display()
    {
        $view = $this->NotFound();
        if (count($this->params) == 0) {
            $view = new GenericView("milestones", $this->getMenu());
            $projects = GetAllByCondition("projects", array("IsCompletedBool" => false), true, "StartDate");
            foreach ($projects as $project) {
                $project->Milestones = GetAllByCondition("milestones", array("ProjectId" => $project->Id), false, "StartDate");
            }
            $view->assign("projects", $projects);
        } else if (count($this->params) > 0 && $this->params[0] == "all") {
            $view = new GenericView("milestones", $this->getMenu());
            $projects = GetAllByCondition("projects", array(), true, "StartDate");
            foreach ($projects as $project) {
                $project->Milestones = GetAllByCondition("milestones", array("ProjectId" => $project->Id), false, "StartDate");
            }
            $view->assign("projects", $projects);
        } else if (count($this->params) > 1 && $this->params[0] == "byproject" && is_numeric($this->params[1])) {
            $proj = GetById("projects", $this->params[1]);
            if ($proj != null) {
                $view = new GenericView("milestones", $this->getMenu(), "milestones of " . $proj->GetIdentification());
                $project = GetSingleByCondition("projects", array("Id" => $this->params[1]), true);
                $project->Milestones = GetAllByCondition("milestones", array("ProjectId" => $project->Id), false, "StartDate");
                $view->assign("projects", array($project));
            } else {
                $view = new GenericView("milestones", $this->getMenu());
                DoLog("project not found", LOG_LEVEL_USER_ERROR);
                $view->assign("projects", array());
            }
        } else {
            if ($this->params[0] == "add") {
                $pm = new MilestoneModel();
                $pm->StartDate = date(DATE_FORMAT_DATABASE, strtotime("today"));
                if (isset($this->params[1]) && is_numeric($this->params[1])) {
                    $proj = GetById("projects", $this->params[1]);
                    if ($proj != null) {
                        $pm->ProjectId = $proj->Id;
                        $pm->DeadlineDate = $proj->DeadlineDate;
                        $pm->PaymentPerHour = $proj->PaymentPerHour;
                        $pm->PercentageComplete = 0;
                    }
                }
                return $this->genericController->Display($pm);
            } else if ($this->params[0] == "edit" && isset($this->params[1]) && is_numeric($this->params[1])) {
                return $this->genericController->Display();
            } else if ($this->params[0] == "delete" && isset($this->params[1]) && is_numeric($this->params[1])) {
                return $this->genericController->Display();
            } else if ($this->params[0] == "active") {
                $view = new GenericView("milestones", $this->getMenu());
                $view->assign("milestones", GetAllByCondition("milestones", array("IsCompletedBool" => false), true, "StartDate DESC"));
            }
        }

        return $view->loadTemplate();
    }
}