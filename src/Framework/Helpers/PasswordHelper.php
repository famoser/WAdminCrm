<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 09.12.2015
 * Time: 18:25
 */

namespace famoser\phpFrame\Helpers;
class PasswordHelper extends HelperBase
{
    public function checkPassword($passwd)
    {
        if (strlen($passwd) > 20) {
            DoLog("Passwort zu lang (maximal 20 Zeichen)", LOG_LEVEL_USER_ERROR);
            return false;
        }

        if (strlen($passwd) < 8) {
            DoLog("Passwort zu kurz (mindestens 8 Zeichen)", LOG_LEVEL_USER_ERROR);
            return false;
        }

        if (!preg_match("#[0-9]+#", $passwd)) {
            DoLog("Passwort muss mindestens eine Zahl enthalten", LOG_LEVEL_USER_ERROR);
            return false;
        }

        if (!preg_match("#[a-z]+#", $passwd)) {
            DoLog("Passwort muss mindestens ein Buchstabe enthalten", LOG_LEVEL_USER_ERROR);
            return false;
        }

        return true;
    }

    public function convertToPasswordHash($password)
    {
        $options = [
            'cost' => 12,
        ];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hash;
    }
}