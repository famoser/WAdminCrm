<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 10.02.2016
 * Time: 11:19
 */

namespace Famoser\phpFrame\Helpers;


class RequestHelper extends HelperBase
{
    public function isAjaxRequest()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            return true;
        return false;
    }

    public function formatParams($uri)
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
}