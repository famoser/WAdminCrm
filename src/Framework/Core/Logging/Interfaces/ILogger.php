<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 10.02.2016
 * Time: 11:22
 */

namespace Famoser\phpFrame\Core\Logging\Interfaces;


use Famoser\phpFrame\Core\Logging\LogItem;

interface ILogger
{
    public function addLogItem(LogItem $item);
    public function getLogItems();
}