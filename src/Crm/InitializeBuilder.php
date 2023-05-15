<?php

namespace Zoho\Crm;

use com\zoho\crm\api\dc\Environment;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\SDKConfigBuilder;
use com\zoho\crm\api\sdkconfigbuilder\SDKConfig;
use Zoho\Api\Authenticator\Store\FileStore;
use Zoho\Api\Authenticator\Store\TokenStore;
use Zoho\Api\Authenticator\Token;
use Zoho\Api\Logger\Levels;
use Zoho\Api\Logger\LogBuilder;
use Zoho\Api\Logger\Logger;
use Zoho\Crm\Util\Constants;
use Zoho\Crm\Util\Utility;

class InitializeBuilder
{
    private $environment;

    private $store;

    private $user;

    private $token;

    private $resourcePath;

    private $requestProxy;

    private $sdkConfig;

    private $logger;

    private $errorMessage;

    private $initializer;

    function __construct()
    {
        $this->initializer = Initializer::getInitializer();

        $this->errorMessage = (Initializer::getInitializer() != null) ? Constants::SWITCH_USER_ERROR : Constants::INITIALIZATION_ERROR;

        if(Initializer::getInitializer() != null)
        {
            $this->user = Initializer::getInitializer()->getUser();

            $this->environment = Initializer::getInitializer()->getEnvironment();

            $this->token = Initializer::getInitializer()->getToken();

            $this->sdkConfig = Initializer::getInitializer()->getSDKConfig();
        }
    }

    public function initialize()
    {
        Utility::assertNotNull($this->user, $this->errorMessage, Constants::USERSIGNATURE_ERROR_MESSAGE);

        Utility::assertNotNull($this->environment, $this->errorMessage, Constants::ENVIRONMENT_ERROR_MESSAGE);

        Utility::assertNotNull($this->token, $this->errorMessage, Constants::TOKEN_ERROR_MESSAGE);

        if(is_null($this->store))
        {
            $this->store = new FileStore(getcwd() . DIRECTORY_SEPARATOR . Constants::TOKEN_FILE);
        }

        if(is_null($this->sdkConfig))
        {
            $this->sdkConfig = (new SDKConfigBuilder())->build();
        }

        if(is_null($this->resourcePath))
        {
            $this->resourcePath = getcwd();
        }

        if(is_null($this->logger))
        {
            $this->logger = (new LogBuilder())->level(Levels::INFO)->filePath(getcwd() . DIRECTORY_SEPARATOR . Constants::LOG_FILE_NAME)->build();
        }

        Initializer::initialize($this->user, $this->environment, $this->token, $this->store, $this->sdkConfig, $this->resourcePath, $this->logger, $this->requestProxy);
    }

    public function switchUser()
    {
        Utility::assertNotNull(Initializer::getInitializer(), Constants::SDK_UNINITIALIZATION_ERROR, Constants::SDK_UNINITIALIZATION_MESSAGE);

        Initializer::switchUser($this->user, $this->environment, $this->token, $this->sdkConfig, $this->requestProxy);
    }

    public function logger(Logger $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    public function token(Token $token)
    {
        Utility::assertNotNull($token, $this->errorMessage, Constants::TOKEN_ERROR_MESSAGE);

        $this->token = $token;

        return $this;
    }

    public function SDKConfig(SDKConfig $sdkConfig)
    {
        $this->sdkConfig = $sdkConfig;

        return $this;
    }

    public function requestProxy(RequestProxy $requestProxy)
    {
        $this->requestProxy = $requestProxy;

        return $this;
    }

    public function resourcePath(string $resourcePath)
    {
        if($resourcePath != null && !is_dir($resourcePath))
        {
            throw new SDKException($this->errorMessage, Constants::RESOURCE_PATH_INVALID_ERROR_MESSAGE);
        }

        $this->resourcePath = $resourcePath;

        return $this;
    }

    public function user(UserSignature $user)
    {
        Utility::assertNotNull($user, $this->errorMessage, Constants::USERSIGNATURE_ERROR_MESSAGE);

        $this->user = $user;

        return $this;
    }

    public function store(TokenStore $store)
    {
        $this->store = $store;

        return $this;
    }

    public function environment(Environment $environment)
    {
        Utility::assertNotNull($environment, $this->errorMessage, Constants::ENVIRONMENT_ERROR_MESSAGE);

        $this->environment = $environment;

        return $this;
    }
}
?>
