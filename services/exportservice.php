<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 25.05.2015
 * Time: 10:40
 */
namespace famoser\WAdminCrm\Services;

class ExportService extends GenericService
{
    public function DownloadDatabaseAndExit()
    {
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/export/" . date("Y-m-d-H-i") . ".sql";

        $fp = @fopen($filename, 'w+');
        if (!$fp) {
            DoLog("Sicherungsdatei konnte nicht erstellt werden (0)", LOG_LEVEL_SYSTEM_ERROR);
        }

        $command = 'mysqldump --opt -h ' . DATABASE_HOST . ' -u ' . DATABASE_USER . ' -p' . DATABASE_USER_PASSWORD . ' ' . DATABASE_NAME . ' > ' . $filename;

        exec($command, $output = array(), $worked);

        switch ($worked) {

            case 0:
                if (file_exists($filename)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename=' . APPLICATION_TITLE . '-database-export-' . basename($filename));
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filename));
                    readfile($filename);
                    exit;
                } else
                    DoLog("Sicherungsdatei wurde nicht gefunden", LOG_LEVEL_SYSTEM_ERROR);
                break;

            case 1:
                DoLog("Sicherungsdatei konnte nicht erstellt werden (1)", LOG_LEVEL_SYSTEM_ERROR);
                break;

            default:
                DoLog("Sicherungsdatei konnte nicht erstellt werden (2)", LOG_LEVEL_SYSTEM_ERROR);
                break;
        }
        return false;
    }
}