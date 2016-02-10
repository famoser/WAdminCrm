<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 10.02.2016
 * Time: 10:51
 */

namespace Famoser\phpFrame\Helpers;


use Exception;

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
        $functionName = "get" . $propName;
        return $obj->$functionName();
    }

    public function getObjectAsJson($object)
    {
        if (is_null($object))
            return "";
        if (is_object($object) || is_array($object))
            return json_encode($object);
        return $object;
    }

    public function getCallStack($skips = 3)
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
}