<?php
/*
Copyright (c) 2021, ZOHO CORPORATION PRIVATE LIMITED 
All rights reserved. 
 
   Licensed under the Apache License, Version 2.0 (the "License"); 
   you may not use this file except in compliance with the License. 
   You may obtain a copy of the License at 
 
       http://www.apache.org/licenses/LICENSE-2.0 
 
   Unless required by applicable law or agreed to in writing, software 
   distributed under the License is distributed on an "AS IS" BASIS, 
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. 
   See the License for the specific language governing permissions and 
   limitations under the License. 
*/

namespace com\zoho\crm\api;

use com\zoho\api\logger\Levels;

use com\zoho\api\logger\Logger;

use com\zoho\crm\api\exception\SDKException;

use com\zoho\crm\api\sdkconfigbuilder\SDKConfig;

use com\zoho\crm\api\util\Constants;

use com\zoho\crm\api\util\RequestProxy;

use com\zoho\crm\api\dc\Environment;

use com\zoho\api\authenticator\Token;

use com\zoho\api\authenticator\store\TokenStore;

use com\zoho\crm\api\UserSignature;

use com\zoho\api\logger\SDKLogger;


/**
 * This class to initialize Zoho CRM SDK.
 */
class Initializer
{
    public static $LOCAL = array();

    private static $initializer;

    private $environment = null;

    private $store = null;

    private $user = null;

    private $token = null;

    public static $jsonDetails = null;

    private $resourcePath = null;

    private $requestProxy = null;

    private $sdkConfig = null;

    /**
     * This to initialize the SDK.
     *
     * @param UserSignature $user A UserSignature class instance represents the CRM user.
     * @param Environment $environment A Environment class instance containing the CRM API base URL and Accounts URL.
     * @param Token $token A Token class instance containing the OAuth client application information.
     * @param TokenStore $store A TokenStore class instance containing the token store information.
     * @param $sdkConfig
     * @param string $resourcePath A String containing the absolute directory path to store user specific JSON files containing module fields information.
     * @param Logger $logger A Logger class instance containing the log file path and Logger type.
     * @param RequestProxy $proxy A RequestProxy class instance containing the proxy properties of the user.
     * @throws SDKException
     */
    public static function initialize($user, $environment, $token, $store, $sdkConfig, $resourcePath, $logger=null, $proxy=null)
    {
        try
        {
            SDKLogger::initialize($logger);

            try
            {
                if(is_null(self::$jsonDetails))
                {
                    self::$jsonDetails = json_decode(file_get_contents(__DIR__ . '/../../../../'. Constants::JSON_DETAILS_FILE_PATH), true);
                }
            }
            catch (\Exception $ex)
            {
                throw new SDKException(Constants::JSON_DETAILS_ERROR, null, null, $ex);
            }

            self::$initializer = new Initializer();

            $initializer = new Initializer();

            $initializer->user = $user;

            $initializer->environment = $environment;

            $initializer->token = $token;

            $initializer->store = $store;

            $initializer->sdkConfig = $sdkConfig;

            $initializer->resourcePath = $resourcePath;

            $initializer->requestProxy = $proxy;

            self::$LOCAL[$initializer->getEncodedKey($user, $environment)] = $initializer;

            self::$initializer = $initializer;

            SDKLogger::info(Constants::INITIALIZATION_SUCCESSFUL . $initializer->toString());
        }
        catch(SDKException $e)
        {
            throw $e;
        }
        catch (\Exception $e)
        {
            throw new SDKException(Constants::INITIALIZATION_EXCEPTION, null, null, $e);
        }
    }

    public static function getJSON($filePath)
    {
        return json_decode(file_get_contents($filePath),TRUE);
    }

    /**
     * This method to get Initializer class instance.
     *
     * @return Initializer A Initializer class instance representing the SDK configuration details.
     */
    public static function getInitializer()
    {
        if (!empty(self::$LOCAL) && count(self::$LOCAL) != 0)
        {
            $initializer = new Initializer();

            $key = $initializer->getEncodedKey(self::$initializer->user, self::$initializer->environment);

            if(array_key_exists($key, self::$LOCAL))
            {
                return self::$LOCAL[$key];
            }
        }

        return self::$initializer;
    }

    /**
     * This method to switch the different user in SDK environment.
     * @param UserSignature $user A UserSignature class instance represents the CRM user.
     * @param Environment $environment A Environment class instance containing the CRM API base URL and Accounts URL.
     * @param Token $token A Token class instance containing the OAuth client application information.
     * @param SDKConfig $sdkConfig A SDKConfig class instance containing the SDK configuration.
     */
    public static function switchUser($user, $environment, $token, $sdkConfig, $proxy=null)
    {
        $initializer = new Initializer();

        $initializer->user = $user;

        $initializer->environment = $environment;

        $initializer->token = $token;

        $initializer->store = self::$initializer->store;

        $initializer->sdkConfig = $sdkConfig;

        $initializer->requestProxy = $proxy;

        $initializer->resourcePath = self::$initializer->resourcePath;

        self::$LOCAL[$initializer->getEncodedKey($user, $environment)] = $initializer;

        self::$initializer = $initializer;

        SDKLogger::info(Constants::INITIALIZATION_SWITCHED . $initializer->toString());
    }

    /**
     * This is a getter method to get API environment.
     *
     * @return Environment A Environment representing the API environment.
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * This is a getter method to get API environment.
     *
     * @return TokenStore A TokenStore class instance containing the token store information.
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * This is a getter method to get CRM User.
     *
     * @return UserSignature A User class instance representing the CRM user.
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * This is a getter method to get RequestProxy.
     *
     * @return RequestProxy A RequestProxy class instance representing the proxy.
     */
    public function getRequestProxy()
    {
        return $this->requestProxy;
    }


    /**
     * This is a getter method to get OAuth client application information.
     *
     * @return Token A Token class instance representing the OAuth client application information.
     */
    public function getToken()
    {
        return $this->token;
    }

    public function getResourcePath()
    {
        return $this->resourcePath;
    }

    /**
     * This is a getter method to get SDK configuration.
     * @return SDKConfig A SDKConfig instance representing the configuration
     */
    public function getSDKConfig()
    {
        return $this->sdkConfig;
    }

    public static function removeUserConfiguration($user, $environment)
    {
        $initializer = new Initializer();

        $key = $initializer->getEncodedKey($user, $environment);

        if(array_key_exists($key, self::$LOCAL))
        {
            unset(self::$LOCAL[$initializer->getEncodedKey($user, $environment)]);
        }
        else
        {
            $exception = new SDKException(null, Constants::USER_NOT_FOUND_ERROR_MESSAGE);

            SDKLogger::info(Constants::USER_NOT_FOUND_ERROR . $exception);

            throw $exception;
        }
    }

    private function getEncodedKey($user, $environment)
    {
        $userMail = $user->getEmail();

        $key = explode("@", $userMail)[0] . $environment->getUrl();

        $input = unpack('C*', utf8_encode($key));

        return base64_encode(implode(array_map("chr", $input)));
    }

    public function toString()
	{
		return Constants::FOR_EMAIL_ID . self::$initializer->getUser()->getEmail() . Constants::IN_ENVIRONMENT . self::$initializer->getEnvironment()->getUrl() . ".";
	}
}
?>