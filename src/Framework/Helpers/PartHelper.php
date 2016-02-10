<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 08.09.2015
 * Time: 15:59
 */

namespace famoser\phpFrame\Helpers;

use DateTime;
use famoser\phpFrame\Helpers\HelperBase;
use Famoser\phpFrame\Helpers\ReflectionHelper;
use famoser\phpFrame\Interfaces\IModel;

class PartHelper extends HelperBase
{
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

    public function getSubmit($customText = "Speichern")
    {
        return '<input type="submit" value="' . $customText . '" class="btn">';
    }

    public function getClassesForMenuItem($view, $params = null, $isSubmenu = false)
    {
        if ($params == null || count($params) == 0 || $view->params == null || count($view->params) == 0)
            return "";

        //clean $params
        $temp = $params;
        $params = array();
        foreach ($temp as $val) {
            if ($val != "")
                $params[] = $val;
        }

        $isSamePage = true;
        for ($i = 0; $i < count($params); $i++) {
            if (!isset($view->params[$i]) || $view->params[$i] != $params[$i]) {
                $isSamePage = false;
            }
        }

        if (!$isSamePage)
            return "";
        $classes = "active";
        if (count($params) == count($view->params))
            $classes .= " active-page";
        else if ($isSubmenu)
            return "";

        return ' class="' . $classes . '" ';
    }
}