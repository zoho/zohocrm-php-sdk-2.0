<?php
namespace Zoho\Api\Authenticator;

use Zoho\Api\Logger\SDKLogger;
use Zoho\Crm\Exception\SDKException;
use Zoho\Crm\Initializer;
use Zoho\Crm\Util\APIHTTPConnector;
use Zoho\Crm\Util\Constants;

/**
 * This class gets the tokens and checks the expiry time.
 */
class OAuthToken implements Token
{
    private $clientID = null;

    private $clientSecret = null;

    private $redirectURL = null;

    private $grantToken = null;

    private $refreshToken = null;

    private $accessToken = null;

    private $expiresIn = null;

    private $userMail = null;

    private $id = null;

    /**
     * This is a setter method to set OAuth client id.
     * @param string A string representing the OAuth client id.
     */
    public function setClientId($clientID)
    {
        $this->clientID = $clientID;
    }

    /**
     * This is a getter method to get OAuth client id.
     * @return string A string representing the OAuth client id.
     */
    public function getClientId()
    {
        return $this->clientID;
    }

    /**
     * This is a getter method to set OAuth client secret.
     * @param string A string representing the OAuth client secret.
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * This is a getter method to get OAuth client secret.
     * @return string A string representing the OAuth client secret.
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * This is a getter method to get OAuth redirect URL.
     * @return string A string representing the OAuth redirect URL.
     */
    public function getRedirectURL()
    {
        return $this->redirectURL;
    }

    /**
     * This is a getter method to set OAuth redirect URL.
     * @param string A string representing the OAuth redirect URL.
     */
    public function setRedirectURL($redirectURL)
    {
        $this->redirectURL = $redirectURL;
    }

    /**
     * This is a setter method to set grant token.
     * @param string A string representing the grant token.
     */
    public function setGrantToken($grantToken)
    {
        $this->grantToken = $grantToken;
    }

    /**
     * This is a getter method to get grant token.
     * @return NULL|string A string representing the grant token.
     */
    public function getGrantToken()
    {
        return $this->grantToken;
    }

    /**
     * This is a getter method to get refresh token.
     * @return NULL|string|mixed A string representing the refresh token.
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * This is a setter method to set refresh token.
     * @param string $refreshToken A string containing the refresh token.
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * This is a getter method to get access token.
     * @return string A string representing the access token.
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * This is a setter method to set access token.
     * @param string $accessToken A string containing the access token.
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * This is a getter method to get token expire time.
     * @return string A string representing the token expire time.
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * This is a setter method to set token expire time.
     * @param string $expiresIn A string containing the token expire time.
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
    }

    /**
     * This is a getter method to get user Mail.
     * @return NULL|string|mixed A string representing the refresh token.
     */
    public function getUserMail()
    {
        return $this->userMail;
    }

    /**
     * This is a setter method to set user Mail.
     * @param string $id A string containing the user Mail.
     */
    public function setUserMail($userMail)
    {
        $this->userMail = $userMail;
    }

    /**
     * This is a getter method to get ID.
     * @return NULL|string|mixed A string representing the refresh token.
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * This is a setter method to set ID.
     * @param string $id A string containing the ID.
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function authenticate(APIHTTPConnector $urlConnection)
    {
        try
        {
            $initializer = Initializer::getInitializer();

            $store = $initializer->getStore();

            $user = $initializer->getUser();

            $oauthToken = null;

            if($this->accessToken == null)
            {
                if($this->id != null)
                {
                    $oauthToken = $store->getTokenById($this->id, $this);
                }
                else
                {
                    $oauthToken = $store->getToken($user, $this);
                }
            }
            else
            {
                $oauthToken = $this;
            }

            $token = null;

            if ($oauthToken == null)//first time
            {
                $token = $this->refreshToken != null ? $this->refreshAccessToken($user, $store)->getAccessToken() : $this->generateAccessToken($user, $store)->getAccessToken();
            }
            else if ($oauthToken->getExpiresIn() != null && $this->isAccessTokenExpired($oauthToken->getExpiresIn())) //access token will expire in next 5 seconds or less
            {
                SDKLogger::info(Constants::REFRESH_TOKEN_MESSAGE);

                $token = $oauthToken->refreshAccessToken($user, $store)->getAccessToken();
            }
            else
            {
                $token = $oauthToken->getAccessToken();
            }

            $urlConnection->addHeader(Constants::AUTHORIZATION, Constants::OAUTH_HEADER_PREFIX . $token);
        }
        catch(SDKException $ex)
        {
            throw $ex;
        }
        catch(\Exception $ex)
        {
            throw new SDKException(null, null, null, $ex);
        }
    }

    public function getResponseFromServer($request_params)
    {
        $curl_pointer = curl_init();

        curl_setopt($curl_pointer, CURLOPT_URL, Initializer::getInitializer()->getEnvironment()->getAccountsUrl());

        curl_setopt($curl_pointer, CURLOPT_HEADER, 1);

        curl_setopt($curl_pointer, CURLOPT_POSTFIELDS, $this->getUrlParamsAsString($request_params));

        curl_setopt($curl_pointer, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl_pointer, CURLOPT_USERAGENT, Constants::USER_AGENT);

        curl_setopt($curl_pointer, CURLOPT_POST, count($request_params));

        curl_setopt($curl_pointer, CURLOPT_CUSTOMREQUEST, Constants::REQUEST_METHOD_POST);

        if(!Initializer::getInitializer()->getSDKConfig()->isSSLVerificationEnabled())
        {
            curl_setopt($curl_pointer, CURLOPT_SSL_VERIFYPEER, false);
        }

        $result = curl_exec($curl_pointer);

        curl_close($curl_pointer);

        return $result;
    }

    private function refreshAccessToken($user, $store)
    {
        $requestParams = array();

        $requestParams[Constants::CLIENT_ID] =  $this->clientID;

        $requestParams[Constants::CLIENT_SECRET] =  $this->clientSecret;

        $requestParams[Constants::GRANT_TYPE] = Constants::REFRESH_TOKEN;

        $requestParams[Constants::REFRESH_TOKEN] =  $this->refreshToken;

        $response = $this->getResponseFromServer($requestParams);

        try
        {
            $this->processResponse($response);

            if($this->id == null)
            {
                $this->generateId();
            }

            $store->saveToken($user, $this);
        }
        catch(SDKException $ex)
        {
            throw $ex;
        }
        catch (\Exception $ex)
        {
            throw new SDKException(null, Constants::SAVE_TOKEN_ERROR, null, $ex);
        }

        return $this;
    }

    public function generateAccessToken($user, $store)
    {
        $requestParams = array();

        $requestParams[Constants::CLIENT_ID] =  $this->clientID;

        $requestParams[Constants::CLIENT_SECRET] =  $this->clientSecret;

        if($this->redirectURL != null)
        {
            $requestParams[Constants::REDIRECT_URI] =  $this->redirectURL;
        }

        $requestParams[Constants::GRANT_TYPE] = Constants::GRANT_TYPE_AUTH_CODE;

        $requestParams[Constants::CODE] = $this->grantToken;

        $response = $this->getResponseFromServer($requestParams);

        try
        {
            $this->processResponse($response);

            $this->generateId();

            $store->saveToken($user, $this);

        }
        catch(SDKException $ex)
        {
            throw $ex;
        }
        catch (\Exception $ex)
        {
            throw new SDKException(null, Constants::SAVE_TOKEN_ERROR, null, $ex);
        }

        return $this;
    }

    public function processResponse($response)
    {
        $headerRows = explode("\n",$response);

        $responseBody = end($headerRows);

        $jsonResponse = json_decode($responseBody, true);

        if (!array_key_exists(Constants::ACCESS_TOKEN, $jsonResponse))
        {
            throw new SDKException(Constants::INVALID_TOKEN_ERROR, array_key_exists(Constants::ERROR, $jsonResponse) ? $jsonResponse[Constants::ERROR] : Constants::NO_ACCESS_TOKEN_ERROR);
        }

        $this->accessToken = $jsonResponse[Constants::ACCESS_TOKEN];

        $this->expiresIn = $this->getTokenExpiresIn($jsonResponse);

        if (array_key_exists(Constants::REFRESH_TOKEN, $jsonResponse))
        {
            $this->refreshToken = $jsonResponse[Constants::REFRESH_TOKEN];
        }

        return $this;
    }

    private function getTokenExpiresIn($response)
    {
        $expireIn = $response[Constants::EXPIRES_IN];

        if(!array_key_exists(Constants::EXPIRES_IN_SEC, $response))
        {
            $expireIn= $expireIn * 1000;
        }

        return $this->getCurrentTimeInMillis() + $expireIn;
    }

    public function getCurrentTimeInMillis()
    {
        return round(microtime(true) * 1000);
    }

    public function isAccessTokenExpired($expiry_time)
    {
        return ((((double)$expiry_time) - $this->getCurrentTimeInMillis()) < 5000);
    }

    public function getUrlParamsAsString($urlParams)
    {
        $paramsAsString = "";

        foreach ($urlParams as $key => $value)
        {
            $paramsAsString = $paramsAsString . $key . "=" . $value . "&";
        }

        $paramsAsString = rtrim($paramsAsString, "&");

        return str_replace(PHP_EOL, '', $paramsAsString);
    }

    public function remove()
    {
        try
        {
            Initializer::getInitializer()->getStore()->deleteToken($this);

            return true;
        }
        catch(SDKException $ex)
        {
            throw $ex;
        }
        catch (\Exception $ex)
        {
            throw new SDKException(null, null, null, $ex);
        }
    }

    /**
     * Creates an OAuthToken class instance with the specified parameters.
     * @param string $clientID A string containing the OAuth client id.
     * @param string $clientSecret A string containing the OAuth client secret.
     * @param string $grantToken A string containing the GRANT token.
     * @param string $refreshToken A string containing the Refresh token.
     * @param string $redirectURL A string containing the OAuth redirect URL.
     * @param string $id A string
     */
    private function __construct($clientID, $clientSecret, $grantToken, $refreshToken, $redirectURL=null, $id=null, $accessToken=null)
    {
        $this->clientID = $clientID;

        $this->clientSecret = $clientSecret;

        $this->grantToken = $grantToken;

        $this->refreshToken = $refreshToken;

        $this->redirectURL = $redirectURL;

        $this->accessToken = $accessToken;

        $this->id = $id;
    }

    private function generateId()
	{
		$email = Initializer::getInitializer()->getUser()->getEmail();

		$builder = Constants::PHP.explode("@",$email)[0]."_";

		$builder .= Initializer::getInitializer()->getEnvironment()->getName()."_";

		$builder .= substr($this->refreshToken, strlen($this->refreshToken) - 4);

		$this->id = $builder;
	}
}
?>
