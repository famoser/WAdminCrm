<?php
/**
 * Created by PhpStorm.
 * User: florianmoser
 * Date: 08.03.16
 * Time: 19:57
 */

namespace famoser\phpFrame\WorkFlows;


use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Services\GenericDatabaseService;
use famoser\phpFrame\Services\RuntimeService;

class SetupWorkFlow extends WorkFlowBase
{
    public function execute()
    {
        if (!GenericDatabaseService::getInstance()->setup())
            LogHelper::getInstance()->logError("GenericDatabaseService could not initialize");
        else
            LogHelper::getInstance()->logUserInfo("GenericDatabaseService initialized");

    }

    private function processLibraries()
    {
        $libFolder = RuntimeService::getInstance()->getFrameworkContentDirectory() . DIRECTORY_SEPARATOR . "libraries";
        if ($libFolder)
    }
}