<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 19:59
 */
function GetCompleteProject($id)
{
    $proj = GetById("projects", $id);
    if ($proj == false)
        return false;

    $proj->Milestones = GetAllByCondition("milestones", array("ProjectId" => $proj->Id), false);
    foreach ($proj->Milestones as $milestone) {
        $milestone->Procedures = GetAllByCondition("procedures", array("MilestoneId" => $milestone->Id), false);
    }
    return $proj;
}