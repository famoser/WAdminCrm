<?php
use famoser\phpFrame\Helpers\HelperBase;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 09.12.2015
 * Time: 18:23
 */

namespace famoser\phpFrame\Helpers;

class FileHelper extends HelperBase
{
    public function fileTypeUploadedFile($tempfilename)
    {
        $arr = explode(".", $_FILES[$tempfilename]["name"]);
        return $arr[count($arr) - 1];
    }

    public function validateUploadedFile($tempfilename, $newpath = null)
    {
        if (!isset($_FILES[$tempfilename]["tmp_name"])) {
            return "Datei wurde nicht gefunden";
        }
        if ($_FILES[$tempfilename]["error"] != UPLOAD_ERR_OK)
            return "Folgender Error ist beim Upload aufgetreten: " . $_FILES[$tempfilename]["error"];

        if ($newpath == null)
            return true;

        if (!move_uploaded_file($_FILES[$tempfilename]["tmp_name"], $newpath))
            return "Datei kann nicht gespeichert werden";

        return true;
    }

    public function getJsonArray($filePath)
    {
        if (file_exists($filePath)) {
            $configJson = file_get_contents($filePath);
            if (strlen($configJson) > 0) {
                return json_decode($configJson, true);
            }
        }
        return false;
    }
}