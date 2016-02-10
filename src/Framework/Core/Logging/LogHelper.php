<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 17.01.2016
 * Time: 22:37
 */

namespace Famoser\phpFrame\Core\Logging;


use Exception;
use Famoser\phpFrame\Core\Logging\Interfaces\ILogger;
use Famoser\phpFrame\Core\Singleton\Singleton;
use Famoser\phpFrame\Helpers\ReflectionHelper;

class LogHelper extends Singleton
{
    const LOG_LEVEL_DEBUG = 0;
    const LOG_LEVEL_INFO = 1;
    const LOG_LEVEL_WARNING = 2;
    const LOG_LEVEL_ERROR = 3;
    const LOG_LEVEL_FATAL = 4;
    const LOG_LEVEL_EXCEPTION = 4;
    const LOG_LEVEL_ASSERT_FAILED = 10;
    const LOG_LEVEL_ASSERT_VALIDATED = 11;

    const LOG_USER_INFO = 20;
    const LOG_USER_ERROR = 30;

    const LOG_TYPE_USER_INFO = 100;
    const LOG_TYPE_USER_ERROR = 101;
    const LOG_TYPE_SYSTEM_ERROR = 102;

    private $loggerImplementation;

    public function __construct()
    {
        $this->loggerImplementation = new Logger();
    }

    public function setLogger(ILogger $loggerImplementation)
    {
        $this->loggerImplementation = $loggerImplementation;
    }

    /**
     * log debug message
     * @param $message
     * @param null $object optional: reference an object which is important to understand the log entry
     */
    public function logDebug($message, $object = null)
    {
        $this->doLog(LogHelper::LOG_LEVEL_DEBUG, $message, $object);
    }

    /**
     * log an informational message
     * @param $message
     */
    public function logInfo($message, $object = null)
    {
        $this->doLog(LogHelper::LOG_LEVEL_INFO, $message, $object);
    }

    /**
     * log a message which may need the attention of the developer, but may not endager the main purpose of the application
     * @param $message
     * @param null $object optional: reference an object which is important to understand the log entry
     */
    public function logWarning($message, $object = null)
    {
        $this->doLog(LogHelper::LOG_LEVEL_WARNING, $message, $object);
    }

    /**
     * log an error which occurred while executing a task and may be related to incorrect data / misconfiguration
     * @param $message
     * @param null $object optional: reference an object which is important to understand the log entry
     */
    public function logError($message, $object = null)
    {
        $this->doLog(LogHelper::LOG_LEVEL_ERROR, $message, $object);
    }

    /**
     * log an error which may be related to a programming mistake, and not related to corrupt data
     * @param $message
     * @param null $object optional: reference an object which is important to understand the log entry
     */
    public function logFatal($message, $object = null)
    {
        $this->doLog(LogHelper::LOG_LEVEL_FATAL, $message, $object);
    }

    /**
     * log an exception
     * @param $exception
     */
    public function logException(Exception $exception, $message = null)
    {
        $msg = $exception->getMessage();
        if ($message != null) {
            $msg = "Message: " . $message . " Exception: " . $msg;
        }
        $this->doLog(LogHelper::LOG_LEVEL_FATAL, $msg, null);
    }


    /**
     * log an Assert (the result of a functionality validation test) as failed
     * @param $message
     * @param null $object optional: reference an object which is important to understand the log entry
     */
    public function logAssertFailed($message, $object = null)
    {
        $this->doLog(LogHelper::LOG_LEVEL_ASSERT_FAILED, $message, $object);
    }

    /**
     * log an Assert (the result of a functionality validation test) as validated
     * @param $message
     * @param null $object optional: reference an object which is important to understand the log entry
     */
    public function logAssertValidated($message, $object = null)
    {
        $this->doLog(LogHelper::LOG_LEVEL_ASSERT_VALIDATED, $message, $object);
    }

    /**
     * log an Assert (the result of a functionality validation test)
     * @param $message
     * @param bool $outcome result of validation
     * @param null $object optional: reference an object which is important to understand the log entry
     */
    public function logAssert($message, bool $outcome, $object = null)
    {
        if ($outcome === true)
            $this->logAssertValidated($message, $object);
        else
            $this->logAssertFailed($message, $object = null);
    }

    /**
     * @param $message
     */
    public function logUserInfo($message)
    {
        $this->doLog(LogHelper::LOG_USER_INFO, $message);
    }

    /**
     * @param $message
     */
    public function logUserError($message)
    {
        $this->doLog(LogHelper::LOG_USER_ERROR, $message);
    }

    /**
     * @return LogItem[]
     */
    public function getLogs()
    {
        return $this->loggerImplementation->getLogItems();
    }

    /**
     * @return int
     */
    public function countLogItems()
    {
        return count($this->loggerImplementation->getLogItems());
    }

    /**
     * @return string as HTML formatted logs
     */
    public function getLogsAsHtml()
    {
        $str = "";
        foreach ($this->loggerImplementation->getLogItems() as $logItem) {
            $str .= "<p>" . $this->renderLogItemAsHtml($logItem) . "</p>";
        }
        return $str;
    }

    /**
     * @return string as string with \n line divisors formatted logs
     */
    public function getLogsAsText()
    {
        $str = "";
        foreach ($this->getLogs() as $logItem) {
            $str .= $this->renderLogItemAsText($logItem) . "\n\n";
        }
        return $str;
    }

    private function renderLogItemAsText(LogItem $log)
    {
        return $this->getLogLevelAsString($log->getLogLevel()) . ": " . $log->getMessage() . "\n" . $log->getSource();
    }

    private function renderLogItemAsHtml(LogItem $log)
    {
        return nl2br("<b>" . $this->getLogLevelAsString($log->getLogLevel()) . "</b>: " . $log->getMessage() . "<br/>" . $log->getSource());
    }

    private function getLogLevelAsString(int $logLevel)
    {
        if ($logLevel == LogHelper::LOG_LEVEL_DEBUG) {
            return "debug";
        } else if ($logLevel == LogHelper::LOG_LEVEL_INFO) {
            return "info";
        } else if ($logLevel == LogHelper::LOG_LEVEL_WARNING) {
            return "warning";
        } else if ($logLevel == LogHelper::LOG_LEVEL_ERROR) {
            return "error";
        } else if ($logLevel == LogHelper::LOG_LEVEL_FATAL) {
            return "fatal";
        } else if ($logLevel == LogHelper::LOG_LEVEL_EXCEPTION) {
            return "exception occured";
        } else if ($logLevel == LogHelper::LOG_LEVEL_ASSERT_FAILED) {
            return "assert failed";
        } else if ($logLevel == LogHelper::LOG_LEVEL_ASSERT_VALIDATED) {
            return "assert validated";
        } else if ($logLevel == LogHelper::LOG_USER_ERROR) {
            return "user error";
        } else if ($logLevel == LogHelper::LOG_USER_INFO) {
            return "user info";
        } else {
            return "logtype unknown";
        }
    }

    private function doLog($level, $message, $object = null)
    {
        $source = ReflectionHelper::getInstance()->getCallStack();

        $addMessage = ReflectionHelper::getInstance()->getObjectAsJson($object);
        if ($addMessage != "")
            $addMessage = " passed object: " . $addMessage;

        $logItem = new LogItem($source, $level, $message . $addMessage);
        $this->addLogItem($logItem);
    }

    private function addLogItem(LogItem $log)
    {
        $this->loggerImplementation->addLogItem($log);
    }
}