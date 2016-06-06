<?php

/**
 * @author Sebastian Paczkowski <s.paczkowskik@madcoders.pl>
 */

namespace MadcodersEditorSDK\Config;

/**
 * Interface ConfigInterface
 *
 * @package MadcodersEditorSDK\Config
 */
interface ConfigInterface
{
    /**
     * Host
     *
     * @return string
     */
    public function getHost();

    /**
     * User
     *
     * @return string
     */
    public function getUser();

    /**
     * Password
     *
     * @return string
     */
    public function getPassword();
}