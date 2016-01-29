<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 25.05.2015
 * Time: 15:11
 */
namespace famoser\WAdminCrm\Services;

use famoser\WAdminCrm\Libraries\PhpMailerHook;

class EmailService extends GenericService
{
    public function SendMail($to, $toname, $betreff, $message)
    {
        return PhpMailerHook::SendEmailFromServer($to, $toname, $betreff, $message);
    }
}