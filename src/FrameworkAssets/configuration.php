<?php


/* Framework */
define("FRAMEWORK_VERSION", "1");

/* Base Settings */

define("AFTER_LOGIN_PAGE", "customers");
define("INCLUDED_FOLDERS", serialize(array("common", "controller", "Models/Models", "Services", "view", "Templates/Helpers")));
define("EXCLUDED_FILES", serialize(array($_SERVER['DOCUMENT_ROOT'] . "/common/configuration_public.php")));
define("CONTROLLERS", '
[
    {"url": "customers", "name": "customers", "icon": "flaticon-profile29"},
    {"url": "projects", "name": "projects", "icon": "flaticon-notes26"},
    {"url": "milestones", "name": "milestones", "icon": "flaticon-notes27"},
    {"url": "procedures", "name": "procedures", "icon": "flaticon-sheet3"},
    {"url": "settings", "name": "settings", "icon": "flaticon-screwdriver26"}
]'
);