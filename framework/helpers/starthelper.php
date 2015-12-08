<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 08.12.2015
 * Time: 22:56
 */

function formatParams($uri)
{
    $arr = explode("/",$uri);

    $params = array();
    for ($i = 1; $i < count($arr); $i++) {
        if ($arr[$i] != "")
            $params[] = $arr[$i];
    }

    if (count($params) > 0) {
        $paramnumber = count($params) - 1;
        $lastparam = $params[$paramnumber];
        if (($index = strpos($lastparam, "?_=")) !== false)
            $params[$paramnumber] = substr($lastparam, 0, $index);
    }

    if (count($params) == 0)
        $params[0] = "";

    return $params;
}