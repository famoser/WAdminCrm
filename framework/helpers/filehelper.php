<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 09.12.2015
 * Time: 18:23
 */
function FileTypeUploadedFile($tempfilename)
{
    $arr = explode(".", $_FILES[$tempfilename]["name"]);
    return $arr[count($arr) - 1];
}

function ValidateUploadedFile($tempfilename, $newpath = null)
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