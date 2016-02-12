<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 08.09.2015
 * Time: 15:59
 */

namespace famoser\phpFrame\Helpers;

use DateTime;
use Famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\HelperBase;
use Famoser\phpFrame\Helpers\ReflectionHelper;
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
    const PART_LOADING_PLACEHOLDER = 15;
    const PART_MENU = 15;
    const PART_MESSAGES = 15;

    /**
     * @param IModel $obj
     * @param string $prop
     * @param string|null $display
     * @param string $type
     * @param string|null $customPlaceholder
     * @param IModel[]|null $special
     * @return string
     */
    public function getInput(IModel $obj, string $prop, string $display = null, string $type = "text", string $customPlaceholder = null, array $special = null)
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

        return '<form ' . $classes . ' action="' . $action . '" method="post">'.$this->getFormToken();
    }

    private function getFormToken()
    {
        $action = RuntimeService::getInstance()->getTotalParams();
        if ($action[count($action) -1] == "create")
            return $this->getHiddenInput("create", "true");

        $allowed = array("update", "delete");

        if (is_numeric($action[count($action) -1]))
        {
            if (in_array($action[count($action) - 2], $allowed)) {
                return $this->getHiddenInput($action[count($action) - 2], "true");
            }
        }
        return "";
    }

    /**
     * @param bool $includeSubmit
     * @return string
     */
    public function getFormEnd($includeSubmit = true)
    {
        $output = "</form>";
        if ($includeSubmit)
            $output = $this->getSubmit().$output;
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

    public function getClassesForMenuSubItem(array $controllerParams, string $menuUrl)
    {
        $params = explode("/", $menuUrl);
        return $this->getClassForMainMenuItem($controllerParams, $params);
    }

    public function getPart(int $const)
    {
        if ($const == PartHelper::PART_HEAD)
            return $this->loadFile("/Templates/_parts/headerPart.php");
        if ($const == PartHelper::PART_FOOTER_CONTENT)
            return $this->loadFile("/Templates/_parts/footer_content.php");
        if ($const == PartHelper::PART_FOOTER_CRUD)
            return $this->loadFile("/Templates/_parts/footer_crud.php");
        if ($const == PartHelper::PART_HEADER_CENTER)
            return $this->loadFile("/Templates/_parts/header_center.php");
        if ($const == PartHelper::PART_HEADER_CONTENT)
            return $this->loadFile("/Templates/_parts/header_content.php");
        if ($const == PartHelper::PART_HEADER_CRUD)
            return $this->loadFile("/Templates/_parts/header_crud.php");
        if ($const == PartHelper::PART_LOADING_PLACEHOLDER)
            return $this->loadFile("/Templates/_parts/loading_placeholder.php");
        if ($const == PartHelper::PART_MENU)
            return $this->loadFile("/Templates/_parts/menu.php");
        if ($const == PartHelper::PART_MESSAGES)
            return $this->loadFile("/Templates/_parts/messages.php");

        LogHelper::getInstance()->logError("Part not found with const " . $const);
        return $this->getPart(PartHelper::PART_MESSAGES);
    }

    private function loadFile($relativeFilePath)
    {
        $filePath = RuntimeService::getInstance()->getFrameworkDirectory() . $relativeFilePath;

        ob_start();
        include $filePath;
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}