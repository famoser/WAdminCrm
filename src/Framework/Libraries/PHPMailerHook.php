<?php

namespace famoser\WAdminCrm\Libraries;

class PhpMailerHook
{
    public function __construct()
    {
        include_once(__DIR__ . "/PHPMailer/PHPMailerAutoload.php");
    }
}