<?php

/**
 * @author Sebastian Paczkowski <s.paczkowskik@madcoders.pl>
 */

namespace MadcodersEditorSDK\Config;

class Config implements ConfigInterface
{
    public function __construct($pathOrFile)
    {
        $this->host = trim(str_replace("HOST:", "", file($pathOrFile)[0]));
        $this->user = trim(str_replace("USER:", "", file($pathOrFile)[1]));
        $this->password = trim(str_replace("PASSWORD:", "", file($pathOrFile)[2]));
    }

    /**
     * Host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * User
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}