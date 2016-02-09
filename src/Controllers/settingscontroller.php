<?php

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 25.05.2015
 * Time: 10:33
 */
class SettingsController extends ControllerBase
{
    private $request = null;
    private $params = null;

    /**
     * Konstruktor, erstellet den Controllers.
     *
     * @param Array $request Array aus $_GET & $_POST.
     */
    public function __construct($request, $requestFiles, $params)
    {
        $this->request = $request;
        $this->params = $params;
    }

    /**
     * Methode zum Anzeigen des Contents.
     *
     * @return String Content der Applikation.
     */
    public function Display()
    {
        $view = $this->NotFound();
        if (count($this->params) == 0 || $this->params[0] == "") {
            $view = new GenericView("settings");
            if (isset($this->request["changepass"])) {
                if ($this->request["Password1"] == $this->request["Password2"]) {
                    if (CheckPassword($this->request["Password1"])) {
                        $params = array();
                        $params["Id"] = GetActiveUser()->Id;
                        $params["PasswordHash"] = $this->request["Password1"];
                        if (AddOrUpdate("admins", $params))
                            DoLog("Das Passwort wurde erfolgreich geändert", LOG_LEVEL_INFO);
                        else
                            DoLog("Das Passwort konnte nicht geändert werden", LOG_LEVEL_SYSTEM_ERROR);
                    } else {
                        //log was done by CheckAdminPass
                    }
                } else {
                    DoLog("Die beiden Passwörter stimmen nicht überein", LOG_LEVEL_USER_ERROR);
                }
                if ($this->request["no-replace"] == true) {
                    exit;
                }
            }
            $view->assign('admins', GetAllOrderedBy("admins", "Id"));
        } else {
            if ($this->params[0] == "Admin") {
                $view = new GenericCrudView($this->params[1], array("add" => "edit"), "settings", "Admin");
                if ($this->params[1] == "add") {
                    if (isset($this->request["add"]) && $this->request["add"] == "true") {
                        unset($this->request["add"]);

                        $res = AddAdmin($this->request);

                        if ($res) {
                            $obj = GetById("admins", $res);
                            if ($obj !== false) {
                                DoLog("Admin wurde hinzugefügt, E-Mail wurde versendet.", LOG_LEVEL_INFO);
                            } else {
                                DoLog("Admin wurde hinzugefügt, E-Mail wurde versendet.", LOG_LEVEL_SYSTEM_ERROR);
                            }
                        }
                    }
                    $view->assign("obj", null);
                } else if ($this->params[1] == "edit") {
                    if (isset($this->request["edit"]) && $this->request["edit"] == "true") {
                        unset($this->request["edit"]);
                        $this->request["Id"] = $this->params[2];
                        $res = Update("admins", $this->request);
                        if ($res) {
                            DoLog("Admin wurde bearbeitet", LOG_LEVEL_INFO);
                        } else
                            $view = new MessageView("Admin konnte nicht bearbeitet werden.", LOG_LEVEL_SYSTEM_ERROR);
                    }
                    $obj = GetById("admins", $this->params[2]);
                    if ($obj !== false) {
                        $view->assign("obj", $obj);
                    } else {
                        $view = new MessageView("Admin wurde nicht gefunden.", LOG_LEVEL_SYSTEM_ERROR);
                    }

                } else if ($this->params[1] == "delete" && isset($this->params[2]) && is_numeric($this->params[2])) {
                    if (isset($this->request["delete"]) && $this->request["delete"] == "true") {
                        $res = DeleteById("admins", $this->params[2]);
                        if ($res) {
                            $view = new MessageView("Admin wurde gelöscht", LOG_LEVEL_INFO);
                        } else
                            $view = new MessageView("Admin konnte nicht gelöscht werden.", LOG_LEVEL_SYSTEM_ERROR);
                    } else {
                        $obj = GetById("admins", $this->params[2]);
                        if ($obj !== false) {
                            $view->assign("obj", $obj);
                        } else {
                            $view = new MessageView("Admin wurde nicht gefunden.", LOG_LEVEL_SYSTEM_ERROR);
                        }
                    }
                } else {
                    $view = $this->NotFound();
                }

            } else if ($this->params[0] == "download") {
                if ($this->params[1] == "database")
                    DownloadDatabaseAndExit();
            }
        }
        return $view->loadTemplate();
    }
}