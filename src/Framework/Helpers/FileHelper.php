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
    const FAILURE_FILE_NOT_FOUND = 10;
    const FAILURE_FILE_UPLOAD_FAILED = 11;
    const FAILURE_FILE_SAVE_FAILED = 12;

    public function getFileTypeUploadedFile($tempfilename)
    {
        $arr = explode(".", $_FILES[$tempfilename]["name"]);
        return $arr[count($arr) - 1];
    }

    public function saveUploadedFile($tempfilename, $newpath)
    {
        if (!isset($_FILES[$tempfilename]["tmp_name"])) {
            return FileHelper::FAILURE_FILE_NOT_FOUND;
        }
        if ($_FILES[$tempfilename]["error"] != UPLOAD_ERR_OK)
            return FileHelper::FAILURE_FILE_UPLOAD_FAILED;

        if (!move_uploaded_file($_FILES[$tempfilename]["tmp_name"], $newpath))
            return FileHelper::FAILURE_FILE_SAVE_FAILED;

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

    public function include_all_files_in_dir($path, $fileEnding)
    {
        foreach (glob($path . "/*." . $fileEnding) as $filename) {
            require_once $filename;
        }
    }

    public function evaluateFailure($const)
    {
        if ($const == FileHelper::FAILURE_FILE_NOT_FOUND)
            return "file not found";
        else if ($const == FileHelper::FAILURE_FILE_SAVE_FAILED)
            return "file could not be saved";
        else if ($const == FileHelper::FAILURE_FILE_UPLOAD_FAILED)
            return "file upload failed";
        return "unknown failure occurred";
    }
}