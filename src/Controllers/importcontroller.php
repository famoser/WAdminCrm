<?php
namespace famoser\crm\Controllers;

use famoser\phpFrame\Controllers\ControllerBase;
use Famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\FileHelper;
use famoser\phpFrame\Services\DatabaseService;
use famoser\phpFrame\Services\LocaleService;
use famoser\phpFrame\Views\GenericView;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 25.05.2015
 * Time: 11:55
 *
 */
class ImportController extends ControllerBase
{
    /**
     * Methode zum Anzeigen des Contents.
     *
     * @return String Content der Applikation.
     */
    public function Display()
    {
        $view = new GenericView("import");

        if (count($this->params) > 0) {
            if ($this->params[0] == "upload") {
                $fileType = FileHelper::getInstance()->getFileTypeUploadedFile('importfile');
                $filePath = $_SERVER['DOCUMENT_ROOT'] . "/import/" . uniqid() . "." . $fileType;
                $resp = FileHelper::getInstance()->saveUploadedFile('importfile', $filePath);
                if ($resp !== true) {
                    LogHelper::getInstance()->logError(FileHelper::getInstance()->evaluateFailure($resp));
                } else {
                    $resp = DatabaseService::getInstance()->importDatabase($filePath);
                    if ($resp == true) {
                        LogHelper::getInstance()->logUserInfo(LocaleService::getInstance()->getResources()->getKey("SUCCESS_GENERAL"));
                    } else {
                        LogHelper::getInstance()->logError(DatabaseService::getInstance()->evaluateError($resp));
                    }
                }
            }
        }

        return $this->returnView($view);
    }
}