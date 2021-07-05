<?php

namespace com\zoho\api\authenticator;

use com\zoho\crm\api\util\Utility;

use com\zoho\crm\api\util\Constants;

use com\zoho\crm\api\exception\SDKException;

class OAuthBuilder
{
    private $clientID;

    private $clientSecret;

    private $redirectURL;

    private $grantToken;

    private $refreshToken;

    private $id;

    public function id($id)
    {
        $this->id = $id;

        return $this;
    }

    public function clientId(string $clientID)
    {
        Utility::assertNotNull($clientID, Constants::TOKEN_ERROR, Constants::CLIENT_ID_NULL_ERROR_MESSAGE);

        $this->clientID = $clientID;

        return $this;
    }

    public function clientSecret(string $clientSecret)
    {
        Utility::assertNotNull($clientSecret, Constants::TOKEN_ERROR, Constants::CLIENT_SECRET_NULL_ERROR_MESSAGE);

        $this->clientSecret = $clientSecret;

        return $this;
    }

    public function redirectURL(string $redirectURL)
    {
        $this->redirectURL = $redirectURL;

        return $this;
    }

    public function refreshToken(string $refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function grantToken(string $grantToken)
    {
        $this->grantToken = $grantToken;

        return $this;
    }

    public function build()
    {
        if($this->grantToken == null && $this->refreshToken == null && $this->id == null)
        {
            throw new SDKException(Constants::MANDATORY_VALUE_ERROR, Constants::MANDATORY_KEY_ERROR, Constants::OAUTH_MANDATORY_KEYS);
        }

        $class = new \ReflectionClass(OAuthToken::class);

        $constructor = $class->getConstructor();

        $constructor->setAccessible(true);

        $object = $class->newInstanceWithoutConstructor();

        $constructor->invoke($object, $this->clientID, $this->clientSecret, $this->grantToken, $this->refreshToken, $this->redirectURL, $this->id);

        return $object;
    }
}