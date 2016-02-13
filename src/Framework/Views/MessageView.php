<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 01.07.2015
 * Time: 09:36
 */

namespace famoser\phpFrame\Views;

use famoser\phpFrame\Helpers\PartHelper;

class MessageView extends ViewBase
{
    protected $message;
    protected $logLevel;
    protected $showLink;

    public function __construct($message, $logLevel = LOG_LEVEL_INFO, $showLink = true)
    {
        $this->message = $message;
        $this->logLevel = $logLevel;
        $this->showLink = $showLink;
        parent::__construct();
    }

    public function loadTemplate()
    {
        $content = $this->loadFile(PartHelper::getInstance()->getPart(PartHelper::PART_HEADER_CENTER));
        $content .= $this->loadFile(PartHelper::getInstance()->getPart(PartHelper::PART_MESSAGES));
        $content .= $this->loadFile(PartHelper::getInstance()->getPart(PartHelper::PART_FOOTER_CENTER));
        return $content;
    }
}