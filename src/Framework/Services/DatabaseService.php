<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 11:40
 */

namespace famoser\phpFrame\Services;


use Famoser\phpFrame\Core\Logging\LogHelper;
use PDO;

class DatabaseService extends ServiceBase
{
    private $PDOs;
    private $defaultPdo;

    const DRIVER_TYPE_MYSQL = 1;
    const DRIVER_TYPE_SQLITE = 2;

    const EXPORT_FAILURE_CAN_NOT_OPEN_FILE = 10;
    const EXPORT_FAILURE_FILE_NOT_CREATED = 11;
    const EXPORT_FAILURE_CREATION_FAILED = 12;
    const EXPORT_FAILURE_UNKNOWN_ERROR = 13;
    const EXPORT_FAILURE_UNSUPPORTED_CONNECTION_TYPE = 14;

    const IMPORT_FAILURE_CAN_NOT_OPEN_FILE = 20;
    const IMPORT_FAILURE_IMPORT_FAILED = 22;
    const IMPORT_FAILURE_UNKNOWN_ERROR = 23;
    const IMPORT_FAILURE_UNSUPPORTED_CONNECTION_TYPE = 24;

    const CONNECTION_FAILURE_NOT_FOUND = 30;

    public function __construct()
    {
        parent::__construct();
    }

    public function exportDatabase($filename, $name = null)
    {
        $connection = $this->resolveConfig($name);
        if ($connection != null) {
            if ($connection["Type"] == "MySql") {
                $fp = @fopen($filename, 'w+');
                if (!$fp) {
                    return DatabaseService::EXPORT_FAILURE_CAN_NOT_OPEN_FILE;
                }

                $command = 'mysqldump --opt -h ' . $connection["Host"] . ' -u ' . $connection["User"] . ' -p' . $connection["Password"] . ' ' . $connection["Database"] . ' > ' . $filename;

                exec($command, $output = array(), $worked);

                switch ($worked) {
                    case 0:
                        if (file_exists($filename)) {
                            return true;
                        } else
                            return DatabaseService::EXPORT_FAILURE_FILE_NOT_CREATED;
                        break;

                    case 1:
                        return DatabaseService::EXPORT_FAILURE_CREATION_FAILED;
                        break;

                    default:
                        return DatabaseService::EXPORT_FAILURE_UNKNOWN_ERROR;
                        break;
                }
            } else if ($connection["Type"] == "Sqlite") {
                if (copy($connection["Path"], $filename) == false)
                    return DatabaseService::EXPORT_FAILURE_FILE_NOT_CREATED;
                return true;
            } else {
                return DatabaseService::EXPORT_FAILURE_UNSUPPORTED_CONNECTION_TYPE;
            }
        } else {
            return DatabaseService::CONNECTION_FAILURE_NOT_FOUND;
        }
    }

    public function importDatabase($filename, $name = null)
    {
        $connection = $this->resolveConfig($name);
        if ($connection != null) {
            if ($connection["Type"] == "MySql") {
                $fp = @fopen($filename, 'w+');
                if (!$fp) {
                    return DatabaseService::IMPORT_FAILURE_CAN_NOT_OPEN_FILE;
                }

                $command = 'mysql -h ' . $connection["Host"] . ' -u ' . $connection["User"] . ' -p' . $connection["Password"] . ' ' . $connection["Database"] . ' < ' . $filename;

                exec($command, $output = array(), $worked);

                switch ($worked) {
                    case 0:
                        return true;
                        break;

                    case 1:
                        return DatabaseService::IMPORT_FAILURE_IMPORT_FAILED;
                        break;

                    default:
                        return DatabaseService::IMPORT_FAILURE_UNKNOWN_ERROR;
                        break;
                }
            } else if ($connection["Type"] == "Sqlite") {
                if (copy($connection["Path"], $filename) == false)
                    return DatabaseService::IMPORT_FAILURE_IMPORT_FAILED;
                return true;
            } else {
                return DatabaseService::IMPORT_FAILURE_UNSUPPORTED_CONNECTION_TYPE;
            }
        } else {
            return DatabaseService::CONNECTION_FAILURE_NOT_FOUND;
        }
    }

    public function evaluateError($const)
    {
        //todo
        return "Faillure";
    }
    /**
     * @param string|null $name
     * @return PDO
     */
    protected function getDatabaseConnection($name = null)
    {
        if ($name == null) {
            if ($this->defaultPdo == null) {
                $connection = $this->resolveConfig($name);
                if ($connection != null) {
                    $newConnection = $this->getConnection($connection);
                    $this->PDOs[$connection["Name"]] = $newConnection;
                    $this->defaultPdo = $newConnection;
                    return $newConnection;
                }
            } else
                return $this->defaultPdo;
        }
        if (!isset($this->PDOs[$name])) {
            $connection = $this->resolveConfig($name);
            if ($connection != null) {
                $newConnection = $this->getConnection($connection);
                $this->PDOs[$connection["Name"]] = $newConnection;
                return $newConnection;
            }
        } else {
            return $this->PDOs[$name];
        }
        return null;
    }

    private function resolveConfig($name = null)
    {
        if ($name == null) {
            foreach ($this->getConfig("Connections") as $connection) {
                if ($connection["Default"] == true) {
                    return $connection;
                }
            }
            if (count($this->getConfig("Connections")) > 0) {
                return $this->getConfig(array("Connections", 0));
            }
        }
        foreach ($this->getConfig("Connections") as $connection) {
            if ($connection["Name"] == $name) {
                return $connection;
            }
        }
        return null;
    }

    private function getConnection($connection)
    {
        if ($connection["Type"] == "MySql") {
            return $this->makePdo("mysql:host=" . $connection["Host"] . ";dbname=" . $connection["Database"] . ";charset=utf8", $connection["User"], $connection["Password"], DatabaseService::DRIVER_TYPE_MYSQL);
        } else {
            LogHelper::getInstance()->logError("Unknown connection type: " . $connection["Type"], $connection);
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