<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 19.02.2016
 * Time: 01:01
 */

namespace famoser\crm\Controllers\Base;


use famoser\phpFrame\Controllers\GenericController;

abstract class TimeTaskController extends GenericController
{
    public function Display($customParams = null)
    {
        if (is_array($customParams))
            $params = $customParams;
        else
            $params = $this->params;

        if (count($params) > 0) {
            if ($params[0] == "archived") {
                $this->getEditObjects()[0]->configureList(null, null, array("IsArchived" => true));
                $params = array();
            }
            if ($params[0] == "completed") {
                $this->getEditObjects()[0]->configureList(null, null, array("IsCompleted" => true));
                $params = array();
            }
        }
        return parent::DisplayExtended($params);
    }
}