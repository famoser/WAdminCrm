<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 08.09.2015
 * Time: 15:59
 */

namespace famoser\phpFrame\Helpers;

use DateTime;
use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Core\Logging\LogItem;
use famoser\phpFrame\Helpers\HelperBase;
use famoser\phpFrame\Helpers\ReflectionHelper;
use famoser\phpFrame\Interfaces\Models\IModel;
use famoser\phpFrame\Services\RuntimeService;

class PartHelper extends HelperBase
{
    const PART_HEAD = 10;
    const PART_FOOTER_CENTER = 11;
    const PART_FOOTER_CONTENT = 11;
    const PART_FOOTER_CRUD = 12;
    const PART_HEADER_CENTER = 13;
    const PART_HEADER_CONTENT = 14;
    const PART_HEADER_CRUD = 15;
    const PART_LOADING_PLACEHOLDER = 16;
    const PART_MENU = 17;
    const PART_MESSAGES = 18;

    /**
     * @param IModel $obj
     * @param string $prop
     * @param string|null $display
     * @param string $type
     * @param string|null $customPlaceholder
     * @param IModel[]|null $special
     * @return string
     */
    public function getInput($obj, $prop, $display = null, $type = "text", $customPlaceholder = null, array $special = null)
    {
        if ($display == null)
            $display = $prop;
        if ($customPlaceholder != null)
            $placeholder = ' placeholder="' . $customPlaceholder . '" ';
        else
            $placeholder = ' placeholder="' . $prop . '" ';

        $val = ReflectionHelper::getInstance()->getPropertyOfObject($obj, $prop);

        $html = '<label for="' . $prop . '">' . $display . '</label><br/>';
        if ($type == "textarea") {
            $html .= '<textarea' . $placeholder . ' class="interactive" id="' . $prop . '" name="' . $prop . '">' . $val . '</textarea>';
        } else if ($type == "select" || (strpos($type, "multiple") !== false && strpos($type, "select") !== false)) {
            $html .= '<select' . $placeholder . ' name="' . $prop . '" id="' . $prop . '"';
            if (strpos($type, "multiple") !== false) {
                $html .= 'multiple';
            }
            $html .= '>';
            foreach ($special as $item) {
                $add = "";
                if ($item->getId() == $val)
                    $add = " selected";
                $html .= '<option value="' . $item->getId() . '"' . $add . '>' . $item->getIdentification() . '</option>';
            }
            $html .= '</select>';
        } else {

            $html .= '<input' . $placeholder . ' id="' . $prop . '" name="' . $prop . '" type="' . $type . '"';
            if ($type == "checkbox") {
                if ($val == 1) {
                    $html .= ' checked="checked" value="true"';
                }
            } else {
                if ($val != null) {
                    if ($type == "date") {
                        $html .= ' value="' . FormatHelper::getInstance()->date($val) . '"';
                    } else if ($type == "datetime") {
                        $html .= ' value="' . FormatHelper::getInstance()->dateTime($val) . '"';
                    } else if ($type == "time") {
                        $html .= ' value="' . FormatHelper::getInstance()->time($val) . '"';
                    } else {
                        $html .= ' value="' . $val . '"';
                    }
                }
            }
            $html .= ">";
            if ($type == "checkbox")
                $html .= $this->getHiddenInput($prop . "CheckboxPlaceholder", true);
        }

        return $html;
    }

    public function getHiddenInput($key, $value)
    {
        return '<input type="hidden" name="' . $key . '" value="' . $value . '">';
    }

    public function getSubmit($customText = "save")
    {
        return '<input type="submit" value="' . $customText . '" class="btn">';
    }

    public function getFormStart($action = null, $ajax = true)
    {
        if ($action == null)
            $action = RuntimeService::getInstance()->getTotalUrl();

        $classes = "";
        if (!$ajax)
            $classes .= 'class="no-ajax"';

        return '<form ' . $classes . ' action="' . $action . '" method="post">' . $this->getFormToken($action);
    }

    private function getFormToken($action)
    {
        $params = explode("/", $action);
        if ($params[count($params) - 1] == "create")
            return $this->getHiddenInput("create", "true");

        $allowed = array("update", "delete");

        if (is_numeric($params[count($params) - 1]) || PasswordHelper::getInstance()->checkIfHashIsValid($params[count($params) - 1])) {
            if (in_array($params[count($params) - 2], $allowed)) {
                return $this->getHiddenInput($params[count($params) - 2], "true");
            }
        } else {
            return $this->getHiddenInput($params[count($params) - 1], "true");
        }
        return "";
    }

    /**
     * @param boolean $includeSubmit
     * @return string
     */
    public function getFormEnd($includeSubmit = true)
    {
        $output = "</form>";
        if ($includeSubmit)
            $output = $this->getSubmit() . $output;
        return $output;
    }

    public function getClassForMainMenuItem(array $routeParams, array $totalParams)
    {
        for ($i = 0; $i < count($routeParams); $i++) {
            if (!isset($totalParams) || $totalParams[$i] != $routeParams[$i])
                return "";
        }
        return ' class="active active-page"';
    }

    public function getClassesForMenuSubItem(array $controllerParams, $menuUrl)
    {
        $params = explode("/", $menuUrl);
        return $this->getClassForMainMenuItem($controllerParams, $params);
    }

    public function getPart($const)
    {
        if ($const == PartHelper::PART_HEAD)
            return RuntimeService::getInstance()->getFrameworkDirectory() ."/Templates/_parts/head.php";
        if ($const == PartHelper::PART_FOOTER_CONTENT)
            return RuntimeService::getInstance()->getFrameworkDirectory() ."/Templates/_parts/footer_content.php";
        if ($const == PartHelper::PART_FOOTER_CRUD)
            return RuntimeService::getInstance()->getFrameworkDirectory() ."/Templates/_parts/footer_crud.php";
        if ($const == PartHelper::PART_HEADER_CENTER)
            return RuntimeService::getInstance()->getFrameworkDirectory() ."/Templates/_parts/header_center.php";
        if ($const == PartHelper::PART_HEADER_CONTENT)
            return RuntimeService::getInstance()->getFrameworkDirectory() ."/Templates/_parts/header_content.php";
        if ($const == PartHelper::PART_HEADER_CRUD)
            return RuntimeService::getInstance()->getFrameworkDirectory() ."/Templates/_parts/header_crud.php";
        if ($const == PartHelper::PART_LOADING_PLACEHOLDER)
            return RuntimeService::getInstance()->getFrameworkDirectory() ."/Templates/_parts/loading_placeholder.php";
        if ($const == PartHelper::PART_MENU)
            return RuntimeService::getInstance()->getFrameworkDirectory() ."/Templates/_parts/menu.php";
        if ($const == PartHelper::PART_MESSAGES)
            return RuntimeService::getInstance()->getFrameworkDirectory() ."/Templates/_parts/messages.php";

        LogHelper::getInstance()->logError("Part not found with const " . $const);
        return PartHelper::getPart(PartHelper::PART_MESSAGES);
    }

    public function getLogClass(LogItem $log)
    {
        $logType = LogHelper::getInstance()->convertToLogType($log->getLogLevel());
        if ($logType == LogHelper::LOG_TYPE_USER_ERROR)
            return "user-error";
        if ($logType == LogHelper::LOG_TYPE_USER_INFO)
            return "info";
        if ($logType == LogHelper::LOG_TYPE_SYSTEM_ERROR)
            return "system-error";
        LogHelper::getInstance()->logError("Unknown logtype", $log);
        return "";
    }

    public function getLogText(LogItem $log)
    {
        return LogHelper::getInstance()->renderLogItemAsHtml($log);
    }
}