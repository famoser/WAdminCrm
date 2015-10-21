<?php

error_reporting(E_ALL);

/* Base Settings */
define("BASEURL","YourURL");

define("DEFAULTDESCRIPTION","Ein Tool für Customer Relationship Managment, Konzept & Umsetzung von Florian Moser");
define("DEFAULTTITLE","CRM");
define("APPLICATION_TITLE","Customer Relationship Managment");
define("AFTER_LOGIN_PAGE","customers");


/* Database */
define("DATABASE_HOST","DATABASE_HOST");
define("DATABASE_NAME","DATABASE_NAME");
define("DATABASE_USER","DATABASE_USER");
define("DATABASE_USER_PASSWORD","DATABASE_USER_PASSWORD");


/* Emails */
define("SERVER_EMAIL", "SERVER_EMAIL");
define("SERVER_EMAIL_PASSWORD", "SERVER_EMAIL_PASSWORD");

define("SERVER_EMAIL_RESPOND_EMAIL", "SERVER_EMAIL_RESPOND_EMAIL");
define("SERVER_EMAIL_RESPOND_NAME", "SERVER_EMAIL_RESPOND_NAME");

define("EMAIL_HOST", "EMAIL_HOST");
define("EMAIL_SECURE", "EMAIL_SECURE");
define("EMAIL_PORT", EMAIL_PORT);


/* Locale */
setlocale(LC_TIME, "de_CH.utf8");
define("LOCALE_DAYS_SER", serialize(array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag")));
define("LOCALE_DAYS_SHORT_SER", serialize(array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa")));
define("LOCALE_MONTHS_SER", serialize(array(1 => "Januar", 2 => "Februar", 3 => "März", 4 => "April", 5 => "Mai", 6 => "Juni", 7 => "Juli", 8 => "August", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Dezember")));


define("LOG_LEVEL_INFO", 1);
define("LOG_LEVEL_USER_ERROR", 2);
define("LOG_LEVEL_SYSTEM_ERROR", 3);


define("DATETIME_FORMAT_DATABASE", "Y-m-d H:i:s");
define("DATETIME_FORMAT_INPUT", "d.m.Y H:i");
define("DATETIME_FORMAT_DISPLAY", "d.m.Y H:i");

define("DATE_FORMAT_DATABASE", "Y-m-d");
define("DATE_FORMAT_INPUT", "Y-m-d");
define("DATE_FORMAT_DISPLAY", "d.m.Y");

define("TIME_FORMAT_DATABASE", "H:i:s");
define("TIME_FORMAT_INPUT", "H:i");
define("TIME_FORMAT_DISPLAY", "H:i");
