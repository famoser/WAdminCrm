<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 10.02.2016
 * Time: 10:51
 */

namespace famoser\phpFrame\Helpers;


use Exception;
use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Models\Database\BaseModel;

class ReflectionHelper extends HelperBase
{
    public function getValue($obj, $prop)
    {
        $val = null;
        if ($obj != null) {
            if (is_array($obj) && isset($obj[$prop]))
                $val = $obj[$prop];
            if (is_object($obj) && isset($obj->$prop))
                $val = $obj->$prop;
        }
        return $val;
    }

    public function getPropertyOfObject($obj, $propName)
    {
        if (is_object($obj)) {
            $functionName = "get" . $propName;
            if (method_exists($obj, $functionName))
                return $obj->$functionName();
            LogHelper::getInstance()->logError("Method " . $functionName . " does not exist");
        }
        return "";
    }

    public function getObjectAsJson($object)
    {
        if (is_null($object))
            return "";
        if (is_object($object) || is_array($object))
            return json_encode($object);
        return $object;
    }

    public function getCallStack($skips = 2)
    {
        $skips++;
        $callStack = "";
        foreach (debug_backtrace() as $item) {
            $args = array();
            foreach ($item["args"] as $arg) {
                if ($arg instanceof Exception)
                    $args[] = "Exception with message: " . $arg->getMessage();
                else
                    $args[] = $arg;
            }
            if ($skips-- <= 0) {
                $callStack .= "at ";
                if (isset($item["function"]))
                    $callStack .= $item["function"];
                if (isset($item["line"]))
                    $callStack .= ", line " . $item["line"];
                if (isset($item["file"]))
                    $callStack .= " in file " . $item["file"];
                $callStack .= " with args " . json_encode($args) . "\n";
            }
        }

        return $callStack;
    }

    public function removeNamespace($model)
    {
        $class = get_class($model);
        return substr($class, strrpos($class, "\\") + 1);
    }

    public function getNamespace($model)
    {
        $class = get_class($model);
        return substr($class, 0, strrpos($class, "\\"));
    }

    public function getClassName($model)
    {
        return get_class($model);
    }

    public function writeFromPostArrayToObjectProperties(array $properties, $model)
    {
        $ignoreKeys = array();
        foreach ($properties as $key => $val) {
            if (!in_array($key, $ignoreKeys)) {
                if (strpos($key, "CheckboxPlaceholder") !== false) {
                    $realName = str_replace("CheckboxPlaceholder", "", $key);
                    if (!isset($params[$realName]))
                        $params[$realName] = false;
                    else if ($params[$realName] == "true")
                        $params[$realName] = true;
                    $ignoreKeys[] = $realName;
                } else {
                    $methodName = "set" . $key;
                    if (method_exists($model, $methodName))
                        $model->$methodName($key);
                }
            }
        }
    }
}