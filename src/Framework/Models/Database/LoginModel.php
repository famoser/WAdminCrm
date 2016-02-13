<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 16:37
 */

namespace famoser\phpFrame\Models\Database;


abstract class LoginModel extends BasePersonalModel
{
    private $Username;
    private $PasswordHash;
    private $AuthHash;

    private $Password;
    private $ConfirmPassword;

    /**
     * @return array
     */
    public function getDatabaseArray()
    {
        $props = array("Username" => $this->getUsername(), "PasswordHash" => $this->getPasswordHash(), "AuthHash" => $this->getAuthHash());
        return array_merge($props, parent::getDatabaseArray());
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->Username;
    }

    /**
     * @param string $Username
     */
    public function setUsername($Username)
    {
        $this->Username = $Username;
    }

    /**
     * @return string
     */
    public function getPasswordHash()
    {
        return $this->PasswordHash;
    }

    /**
     * @param string $PasswordHash
     */
    public function setPasswordHash($PasswordHash)
    {
        $this->PasswordHash = $PasswordHash;
    }

    /**
     * @return string
     */
    public function getAuthHash()
    {
        return $this->AuthHash;
    }

    /**
     * @param string $AuthHash
     */
    public function setAuthHash($AuthHash)
    {
        $this->AuthHash = $AuthHash;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param mixed $Password
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->ConfirmPassword;
    }

    /**
     * @param mixed $ConfirmPassword
     */
    public function setConfirmPassword($ConfirmPassword)
    {
        $this->ConfirmPassword = $ConfirmPassword;
    }
}