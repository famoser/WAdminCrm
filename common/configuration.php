<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Framework */
define("FRAMEWORK_VERSION", "1");

/* Base Settings */
define("BASEURL", "https://crm.florianalexandermoser.ch/");

define("DEFAULTDESCRIPTION", "Ein Tool für Customer Relationship Managment, Konzept & Umsetzung von Florian Moser");
define("DEFAULTTITLE", "CRM");
define("APPLICATION_TITLE", "Customer Relationship Managment");
define("AFTER_LOGIN_PAGE", "customers");
define("INCLUDED_FOLDERS", serialize(array("common", "controller", "classes/models", "services", "view", "templates/helpers")));
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

/* Database */
define("DATABASE_HOST", "floria74.mysql.db.internal");
define("DATABASE_NAME", "floria74_scms");
define("DATABASE_USER", "floria74_scms");
define("DATABASE_USER_PASSWORD", "tzaOA2GH");


/* Emails */
define("SERVER_EMAIL", "server@florianalexandermoser.ch");
define("SERVER_EMAIL_PASSWORD", "IJYKC7XO");

define("SERVER_EMAIL_RESPOND_EMAIL", "info@florianalexandermoser.ch");
define("SERVER_EMAIL_RESPOND_NAME", "Florian Moser");

define("EMAIL_HOST", "asmtp.mail.hostpoint.ch");
define("EMAIL_SECURE", "tls");
define("EMAIL_PORT", 587);

/* Locale */
setlocale(LC_TIME, "de_CH.utf8");
define("LOCALE_DAYS_SER", serialize(array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag")));
define("LOCALE_DAYS_SHORT_SER", serialize(array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa")));
define("LOCALE_MONTHS_SER", serialize(array(1 => "Januar", 2 => "Februar", 3 => "März", 4 => "April", 5 => "Mai", 6 => "Juni", 7 => "Juli", 8 => "August", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Dezember")));

define("DATETIME_FORMAT_DATABASE", "Y-m-d H:i:s");
define("DATETIME_FORMAT_INPUT", "d.m.Y H:i");
define("DATETIME_FORMAT_DISPLAY", "d.m.Y H:i");

define("DATE_FORMAT_DATABASE", "Y-m-d");
define("DATE_FORMAT_INPUT", "Y-m-d");
define("DATE_FORMAT_DISPLAY", "d.m.Y");

define("TIME_FORMAT_DATABASE", "H:i:s");
define("TIME_FORMAT_INPUT", "H:i");
define("TIME_FORMAT_DISPLAY", "H:i");
define("CURRENCY", "CHF");