<?php
namespace famoser\crm\Controllers;

use famoser\crm\Models\Database\MilestoneModel;
use famoser\crm\Models\Database\ProcedureModel;
use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Controllers\Generic1nController;
use famoser\phpFrame\Helpers\FormatHelper;
use famoser\phpFrame\Services\GenericDatabaseService;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 16:03
 */
class ProceduresController extends Generic1nController
{
    public function __construct($request, $params, $files)
    {
        parent::__construct($request, $params, $files, new ProcedureModel(), array(Generic1nController::CRUD_CREATE => Generic1nController::CRUD_READ));
    }

    public function Display()
    {
        if (count($this->params) > 0) {
            if ($this->params[0] == "archived") {
                return parent::Display(array(), null, "StartDateTime DESC");
            } else if (count($this->params) > 1 && is_numeric($this->params[1])) {
                if ($this->params[0] == "add") {
                    $model = $this->getObjectInstance();
                    if ($model instanceof ProcedureModel) {
                        $lastEndDateTime = GenericDatabaseService::getInstance()->getPropertyByCondition($this->getObjectInstance(), "EndDateTime", array("MilestoneId" => $this->params[1]), "EndDateTime DESC");
                        if ($lastEndDateTime != null) {
                            if (FormatHelper::getInstance()->timeSpanMinutesShort($lastEndDateTime, FormatHelper::getInstance()->dateTimeFromString("now")) < 400)
                                $model->setStartDateTime($lastEndDateTime);
                            else
                                $model->setStartDateTime(FormatHelper::getInstance()->dateTimeFromString("now - 1 hour"));
                        }
                    }
                }
            }
        }
        return parent::DisplayExtended(null, "StartDateTime DESC", new MilestoneModel(), "Milestone");
    }
}