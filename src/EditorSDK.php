<?php

/**
 * @author Sebastian Paczkowski <s.paczkowskik@madcoders.pl>
 *
 */

namespace MadcodersEditorSDK;

use MadcodersEditorSDK\Config\ConfigInterface;
use MadcodersEditorSDK\Config\Config;

class EditorSDK
{
    protected $config;
    private $token;

    public function __construct(ConfigInterface $config = null)
    {
        if ($config === null) {
            if (!file_exists($config = __DIR__ . '/config.yml')) {
                //throw new Exception('FileNotFoundException');
            }
        }

        $this->config = new Config($config);
    }

    /**
     * Configuration
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function isToken()
    {
        return isset($this->token) && !empty($this->token);
    }

    /**
     * Set authorization header using curl
     *
     * @param $ch
     */
    protected function auth($ch)
    {
        $username = $this->config->getUser();
        $password = $this->config->getPassword();
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    }

    public function login($returnUrl = null)
    {
        $apiUrl = 'api/authenticate';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config->getHost() . $apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $this->auth($ch);
        $this->token = curl_exec($ch);

//        if ($this->isToken())
//            throw new Exception('authenticationFailedException');

        if ($returnUrl) {
            header('Location: '. $returnUrl);
            exit();
        }
    }

    public function get($resource = 'grid', $id)
    {
        $apiUrl = 'edytor-website/' . $id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config->getHost() . $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);

        $result = curl_exec($ch);

//            if (curl_errno($ch))
//                throw new Exception('pageNotFoundException');

        curl_close($ch);
        return $result;
    }
}
