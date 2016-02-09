<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 11:40
 */

namespace famoser\phpFrame\Services;


use PDO;

class DatabaseService extends ServiceBase
{
    protected function GetDatabaseConnection()
    {
        $db = new PDO("mysql:host=" . DATABASE_HOST .";dbname=" . DATABASE_NAME . ";charset=utf8",DATABASE_USER,DATABASE_USER_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
    }
}