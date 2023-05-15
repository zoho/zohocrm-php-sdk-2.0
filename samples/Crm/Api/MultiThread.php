<?php
namespace samples\src\com\zoho\crm\api\threading\multiuser;

use com\zoho\crm\api\record\GetRecordsHeader;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\SDKConfigBuilder;
use Zoho\Api\Authenticator\OAuthBuilder;
use Zoho\Api\Authenticator\Store\DBBuilder;
use Zoho\Api\Logger\Levels;
use Zoho\Api\Logger\LogBuilder;
use Zoho\Crm\DataCenters\UnitedState;
use Zoho\Crm\HeaderMap;
use Zoho\Crm\InitializeBuilder;
use Zoho\Crm\ParameterMap;
use Zoho\Crm\UserSignature;

class MultiThread
{
	public function main()
	{
		$logger = (new LogBuilder())
		->level(Levels::INFO)
		->filePath("/Users/user_name/Documents/php_sdk_log.log")
		->build();

		$environment1 = UnitedState::PRODUCTION();

		$user1 = new UserSignature("abc@zoho.com");

		$tokenstore = (new DBBuilder())
		->host("hostName")
		->databaseName("databaseName")
		->userName("userName")
		->portNumber("portNumber")
		->tableName("tableName")
		->password("password")
		->build();

		//Create a Token instance
		$token1 = (new OAuthBuilder())
		->clientId("ClientId1")
		// ->id("php_abc_us_prd_")
		->clientSecret("ClientSecret1")
		// ->grantToken("GrantToken")
		->refreshToken("RefreshToken")
		// ->redirectURL("RedirectURL")
		->build();

        $resourcePath ="/Users/user_name/Documents/php-sdk-application/";

        $builderInstance = new SDKConfigBuilder();

        $autoRefreshFields = false;

		$pickListValidation = false;

		$enableSSLVerification = true;

		$builderInstance = new SDKConfigBuilder();

		$connectionTimeout = 50; //The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.

    	$timeout = 50; //The maximum number of seconds to allow cURL functions to execute.

        $configInstance = $builderInstance
		->autoRefreshFields($autoRefreshFields)
		->pickListValidation($pickListValidation)
		->sslVerification($enableSSLVerification)
		->connectionTimeout($connectionTimeout)
		->timeout($timeout)
		->build();

        (new InitializeBuilder())
		->user($user1)
		->environment($environment1)
		->token($token1)
		->store($tokenstore)
		->SDKConfig($configInstance)
		->resourcePath($resourcePath)
		->logger($logger)
		->initialize();

        $this->getRecords("Leads");

		$environment2 = UnitedState::PRODUCTION();

		$user2 = new UserSignature("xyz@zoho.com");

        //Create a Token instance
		$token2 = (new OAuthBuilder())
		->clientId("ClientId2")
		// ->id("php_abc_us_prd_")
		->clientSecret("ClientSecret2")
		// ->grantToken("GrantToken")
		->refreshToken("RefreshToken")
		// ->redirectURL("RedirectURL")
		->build();

        (new InitializeBuilder())
		->user($user2)
		->environment($environment2)
		->token($token2)
		->SDKConfig($configInstance)
		->switchUser();

        $this->getRecords("Leads");

        (new InitializeBuilder())
		->user($user1)
		->environment($environment1)
		->token($token1)
		->SDKConfig($configInstance)
		->switchUser();

        $this->getRecords("apiName2");
    }

    public function getRecords($moduleAPIName)
    {
        try
        {
            $recordOperations = new RecordOperations();

            $paramInstance = new ParameterMap();

            $headerInstance = new HeaderMap();

            $ifmodifiedsince = date_create("2020-06-02T11:03:06+05:30")->setTimezone(new \DateTimeZone(date_default_timezone_get()));

            $headerInstance->add(GetRecordsHeader::IfModifiedSince(), $ifmodifiedsince);

            //Call getRecord method that takes paramInstance, moduleAPIName as parameter
            $response = $recordOperations->getRecords($moduleAPIName,$paramInstance, $headerInstance);

            echo($response->getStatusCode() . "\n");

            print_r($response);

            echo("\n");
        }
        catch (\Exception $e)
        {
            print_r($e);
        }
    }
}

$obj = new MultiThread();

$obj->main();

?>
