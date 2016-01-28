<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 04.06.2015
 * Time: 21:28
 */
namespace famoser\WAdminCrm\Services;

class ImportService
{
    function ImportDatabase($execute, $filename)
    {
        if (!$execute) {
            DoLog("Diese Datei enthält eine Sicherung der Datenbank. Die Datenbank wir dadurch auf den Zeitpunkt des Exportes zurückgesetzt. Dieser Vorgang kann nicht rückgängig gemacht werden!", LOG_LEVEL_USER_ERROR);
            return true;
        }
        $command = 'mysql -h ' . DATABASE_HOST . ' -u ' . DATABASE_USER . ' -p' . DATABASE_USER_PASSWORD . ' ' . DATABASE_NAME . ' < ' . $filename;

        exec($command, $output = array(), $worked);

        switch ($worked) {

            case 0:
                DoLog('Der Import wurde erfolgreich abgeschlossen');
                break;
            case 1:
                DoLog('Der Import ist fehlgeschlagen! (0)');
                break;
            default:
                DoLog('Der Import ist fehlgeschlagen! (1)');
                break;
        }
        return true;
    }
}