<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 10.02.2016
 * Time: 11:22
 */

namespace Famoser\phpFrame\Core\Logging;


use Famoser\phpFrame\Core\Logging\Interfaces\ILogger;

class Logger implements ILogger
{
    private $logItems = array();

    public function addLogItem(LogItem $item)
    {
        $this->logItems[] = $item;
    }

    /**
     * @return LogItem[]
     */
    public function getLogItems()
    {
        return $this->logItems;
    }

    /**
     * @return string as HTML formatted logs
     */
    public function getLogsAsHtml()
    {
        $str = "";
        foreach ($this->getLogItems() as $logItem) {
            $str .= "<p>" . $logItem->renderAsHtml() . "</p>";
        }
        return $str;
    }

    /**
     * @return string as string with \n line divisors formatted logs
     */
    public function getLogsAsText()
    {
        $str = "";
        foreach ($this->getLogItems() as $logItem) {
            $str .= $logItem->renderAsText() . "\n\n";
        }
        return $str;
    }
}