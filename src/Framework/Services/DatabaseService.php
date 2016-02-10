<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 11:40
 */

namespace famoser\phpFrame\Services;


use Famoser\phpFrame\Core\Logging\Logger;
use PDO;

class DatabaseService extends ServiceBase
{
    private $PDOs;
    private $defaultPdo;

    const DRIVER_TYPE_MYSQL = 1;
    const DRIVER_TYPE_SQLITE = 2;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string|null $name
     * @return PDO
     */
    protected function GetDatabaseConnection($name = null)
    {
        if ($name == null) {
            if ($this->defaultPdo == null) {
                foreach ($this->config["Connections"] as $connection) {
                    if ($connection["Default"] == true) {
                        $newConnection = $this->getConnection($connection);
                        $this->PDOs[$connection["Name"]] = $newConnection;
                        $this->defaultPdo = $newConnection;
                        return $newConnection;
                    }
                }
                if (count($this->config["Connections"]) > 0) {
                    $newConnection = $this->getConnection($this->config["Connections"][0]);
                    $this->PDOs[$this->config["Connections"][0]["Name"]] = $newConnection;
                    $this->defaultPdo = $newConnection;
                    return $newConnection;
                }
            } else
                return $this->defaultPdo;
        }
        if (!isset($this->PDOs[$name])) {
            foreach ($this->config["Connections"] as $connection) {
                if ($connection["Name"] == $name) {
                    $newConnection = $this->getConnection($connection);
                    $this->PDOs[$connection["Name"]] = $newConnection;
                    return $newConnection;
                }
            }
        } else {
            return $this->PDOs[$name];
        }
        return null;
    }

    private function getConnection($connection)
    {
        if ($connection["Type"] == "MySql") {
            return $this->makePdo("mysql:host=" . $connection["Host"] . ";dbname=" . $connection["Database"] . ";charset=utf8", $connection["User"], $connection["Password"], DatabaseService::DRIVER_TYPE_MYSQL);
        } else {
            Logger::getInstance()->logError("Unknown connection type: " . $connection["Type"], $connection);
            return null;
        }
    }

    /**
     * @param $host
     * @param $user
     * @param $password
     * @return PDO
     */
    private function makePdo($host, $user, $password, $type)
    {
        $db = new PDO($host, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
    }
}