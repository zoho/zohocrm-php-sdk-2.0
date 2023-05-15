License
=======

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

# ZOHO CRM PHP SDK 2.0 for API version 2.0

## Table Of Contents

* [Overview](#overview)
* [Registering a Zoho Client](#registering-a-zoho-client)
* [Environmental Setup](#environmental-setup)
* [Including the SDK in your project](#including-the-sdk-in-your-project)
* [Persistence](#token-persistence)
  * [DataBase Persistence](#database-persistence)
  * [File Persistence](#file-persistence)
  * [Custom Persistence](#custom-persistence)
* [Configuration](#configuration)
* [Initialization](#initializing-the-application)
* [Class Hierarchy](#class-hierarchy)
* [Responses And Exceptions](#responses-and-exceptions)
* [Multi-User support in the PHP SDK](#multi-user-support-in-the-php-sdk)
* [Sample Code](#sdk-sample-code)

## Overview

Zoho CRM PHP SDK offers a way to create client PHP applications that can be integrated with Zoho CRM.

## Registering a Zoho Client

Since Zoho CRM APIs are authenticated with OAuth2 standards, you should register your client app with Zoho. To register your app:

- Visit this page [https://api-console.zoho.com/](https://api-console.zoho.com)

- Click on `ADD CLIENT`.

- Choose the `Client Type`.

- Enter **Client Name**, **Client Domain** or **Homepage URL** and **Authorized Redirect URIs** then click `CREATE`.

- Your Client app will be created.

- Select the created OAuth client.

- Generate grant token by providing the necessary scopes, time duration (the duration for which the generated token is valid) and Scope Description.

## Environmental Setup

PHP SDK is installable through **Composer**. **Composer** is a tool for dependency management in PHP. SDK expects the following from the client app.

- Client app must have PHP(version 7 and above) with curl extension enabled.

- PHP SDK must be installed into client app though **Composer**.

## Including the SDK in your project

You can include the SDK to your project using:

- Install **Composer** (if not installed).

  - Run this command to install the composer.

    ```sh
    curl -sS https://getcomposer.org/installer | php
    ```

  - To install composer on mac/linux machine:

    ```sh
    https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx
    ```

  - To install composer on windows machine:

    ```sh
    https://getcomposer.org/doc/00-intro.md#installation-windows
    ```

- Install **PHP SDK**.

  - Navigate to the workspace of your client app.

  - Run the command below:

    ```sh
    composer require zohocrm/php-sdk-2.0
    ```

  - The PHP SDK will be installed and a package named vendor will be created in the workspace of your client app.

- Using the SDK.

  - Add the below line in PHP files of your client app, where you would like to make use of PHP SDK.

    ```php
    require 'vendor/autoload.php';
    ```

  Through this line, you can access all the functionalities of the PHP SDK. The namespaces of the class to be used must be included within the "use" statement.

## Token Persistence

Token persistence refers to storing and utilizing the authentication tokens that are provided by Zoho.  Token persistence enables the SDK to automatically refresh the access token after initialization using the refresh token without the need for user intervention. There are three ways provided by the SDK in which persistence can be applied. They are file persistence, DB persistence and Custom persistence. Please note that the default method of token persistence provided by the Zoho CRM SDK is File persistence.

### Table of Contents

- [DataBase Persistence](#database-persistence)

- [File Persistence](#file-persistence)

- [Custom Persistence](#custom-persistence)

### Implementing OAuth Persistence

Once the application is authorized, OAuth access and refresh tokens can be used for subsequent user data requests to Zoho CRM. Hence, they need to be persisted by the client app.

The persistence is achieved by writing an implementation of the inbuilt **TokenStore interface**, which has the following callback methods.

- **getToken($user, $token)** - invoked before firing a request to fetch the saved tokens. This method should return an implementation of **Token interface** object for the library to process it.

- **saveToken($user, $token)** - invoked after fetching access and refresh tokens from Zoho.

- **deleteToken($token)** - invoked before saving the latest tokens.

- **getTokens()** - The method to retrieve all the stored tokens.

- **deleteTokens()** - The method to delete all the stored tokens.

- **getTokenById($id, $token)** - This method is used to retrieve the user token details based on unique ID.

Note:

- $id is a string.

- $user is an instance of **UserSignature**.

- $token is an instance of **Token** interface.

### DataBase Persistence

Database persistence is a technique that involves storing and retrieving data from a database.  In case the user prefers to use the default DataBase persistence, **MySQL** can be used.

- The database name should be **zohooauth**.

- There must be a table named **oauthtoken** with the following columns.

  - id varchar(255)

  - user_mail varchar(255)

  - client_id varchar(255)

  - client_secret varchar(255)

  - refresh_token varchar(255)

  - access_token varchar(255)

  - grant_token varchar(255)

  - expiry_time varchar(20)

  - redirect_url varchar(255)

Note:
- Custom database name and table name can be set in DBStore instance

#### MySQL Query

```sql
CREATE TABLE oauthtoken (
  id varchar(255) NOT NULL,
  user_mail varchar(255) NOT NULL,
  client_id varchar(255),
  client_secret varchar(255),
  refresh_token varchar(255),
  access_token varchar(255),
  grant_token varchar(255),
  expiry_time varchar(20),
  redirect_url varchar(255),
  primary key (id)
);
```

#### Create DBStore object

```php
/*
* Create an instance of TokenStore.
* host -> DataBase host name. Default "localhost"
* databaseName -> DataBase name. Default "zohooauth"
* userName -> DataBase user name. Default "root"
* tableName -> DataBase table name. Default "oauthtoken"
* password -> DataBase password. Default ""
* portNumber -> DataBase port number. Default "3306"
*/
// $tokenstore = (new DBBuilder())->build();
$tokenstore = (new DBBuilder())
->host("hostName")
->databaseName("databaseName")
->userName("userName")
->portNumber("portNumber")
->tableName("tableName")
->password("password")
->build();
```

### File Persistence

File persistence is a simple approach for storing and retrieving data that is saved to a file on local drive. In case of default File Persistence, the user can persist tokens in the local drive, by providing the the absolute file path to the FileStore object.

- The File contains

  - id

  - user_mail

  - client_id

  - client_secret

  - refresh_token

  - access_token

  - grant_token

  - expiry_time

  - redirect_url

#### Create FileStore object

```php
//Parameter containing the absolute file path to store tokens
$tokenstore = new FileStore("/Documents/php_sdk_token.txt");
```

### Custom Persistence

Users can create their own logic for storing and retrieving authentication tokens using the custom persistence technique.  To use Custom Persistence, the user must implement **TokenStore interface** (**com\zoho\api\authenticator\store\TokenStore**) and override the methods.

```php
use Zoho\Api\Authenticator\Store\TokenStore;use Zoho\Api\Authenticator\Token;use Zoho\Crm\Exception\SDKException;

class CustomStore implements TokenStore
{
    /**
      * @param user A UserSignature class instance.
      * @param token A Token (com\zoho\api\authenticator\OAuthToken) class instance.
      * @return A Token class instance representing the user token details.
      * @throws SDKException if any problem occurs.
    */
    public function getToken($user, $token)
    {
      // Add code to get the token
      return null;
    }
    /**
      * @param user A UserSignature class instance.
      * @param token A Token (com\zoho\api\authenticator\OAuthToken) class instance.
      * @throws SDKException if any problem occurs.
    */
    public function saveToken($user, $token)
    {
      // Add code to save the token
    }
    /**
      * @param token A Token (com\zoho\api\authenticator\OAuthToken) class instance.
      * @throws SDKException if any problem occurs.
    */
    public function deleteToken($token)
    {
      // Add code to delete the token
    }
    /**
      * @return array  An array of Token (com\zoho\api\authenticator\OAuthToken) class instances
    */
    public function getTokens()
    {
      //Add code to retrieve all the stored tokens
    }

    public function deleteTokens()
    {
      //Add code to delete all the stored tokens.
    }

    /**
      * @param id A string.
      * @param token A Token (com\zoho\api\authenticator\OAuthToken) class instance.
      * @return A Token class instance representing the user token details.
      * @throws SDKException if any problem occurs.
    */
    public function getTokenById($id, $token)
    {
      // Add code to get the token using unique id
      return null;
    }
}
```

## Configuration

Before you get started with creating your PHP application, you need to register your client and authenticate the app with Zoho.

| Mandatory Keys    | Optional Keys |
| :---------------- | :------------ |
| user              | logger        |
| environment       | store         |
| token             | SDKConfig     |
|                   | requestProxy  |
|                   | resourcePath  |
----

The **user** key will be used to store and identify the **tokenstore** details in the DB or File Storage for token persistence. The **environment** key contains the domain information to make API calls. The **token** key represents the OAuth info, including the clientID, clientSecret, grantToken, redirectURL, refreshToken or accessToken depending on the flow that you use. Refer to ##create an instance of OAuthToken## for more details. 


- Create an instance of **UserSignature** that identifies the current user.

    ```php
    //Create an UserSignature instance that takes user Email as parameter
    $user = new UserSignature("abc@zoho.com");
    ```

- Configure the API environment which decides the domain and the URL to make API calls.

    ```php
    /*
    * Configure the environment
    * which is of the pattern Domain::Environment
    * Available Domains: USDataCenter, EUDataCenter, INDataCenter, CNDataCenter, AUDataCenter
    * Available Environments: PRODUCTION(), DEVELOPER(), SANDBOX()
    */
    $environment = USDataCenter::PRODUCTION();
    ```

- Create an instance of **OAuthToken** with the information that you get after registering your Zoho client. In the context of token persistence, the grant token flow and refresh token flow involve storing and persisting the token. However, the access token flow does not involve token persistence and the access token is directly utilized for API calls. Depending on the tokens available with you, choose grantToken flow, refreshToken flow or accessToken flow.  

  - Use the following method for **grantToken flow :**
  ```php
    $token = (new OAuthBuilder())
    ->clientId("clientId")
    ->clientSecret("clientSecret")
    ->grantToken("grantToken")
    ->redirectURL("redirectURL")
    ->build();
    ```
  - Use the following method for **refreshToken flow :**
  ```php
    $token = (new OAuthBuilder())
    ->clientId("clientId")
    ->clientSecret("clientSecret")
    ->refreshToken("refreshToken")
    ->redirectURL("redirectURL")
    ->build();
  ```

  - Use the following method for **accessToken flow :**
  ```php
    $token = (new OAuthBuilder())
    ->accessToken("accessToken")
    ->build();
  ```

- Create an instance of **Logger** Class to log exception and API information. By default, the SDK constructs a Logger instance with level - INFO and file_path - (sdk_logs.log, created in the current working directory)

    ```php
    /*
    * Create an instance of Logger Class that requires the following
    * level -> Level of the log messages to be logged. Can be configured by typing Levels "::" and choose any level from the list displayed.
    * filePath -> Absolute file path, where messages need to be logged.
    */
    $logger = (new LogBuilder())
    ->level(Levels::INFO)
    ->filePath("/Documents/php_sdk_log.log")
    ->build();
    ```

- Create an instance of **TokenStore** to persist tokens, used for authenticating all the requests. By default, the SDK creates the sdk_tokens.txt in the current working directory to persist the tokens.

  - Use the following method for DB Store
    ```php
    /*
    * Create an instance of DBStore that requires the following
    * host -> DataBase host name. Default value "localhost"
    * databaseName -> DataBase name. Default  value "zohooauth"
    * userName -> DataBase user name. Default value "root"
    * password -> DataBase password. Default value ""
    * portNumber -> DataBase port number. Default value "3306"
    * tabletName -> DataBase table name. Default value "oauthtoken"
    */
    $tokenstore = (new DBBuilder())
    ->host("hostName")
    ->databaseName("dataBaseName")
    ->userName("userName")
    ->password("password")
    ->portNumber("portNumber")
    ->tableName("tableName")
    ->build();
    ```
  - Use the following method for File Store
    ```php
    $tokenstore = new FileStore("absolute_file_path");
    ```
  - Use the following method for Custom Store
    ```php
    $tokenstore = new CustomStore();
    ```

- Create an instance of SDKConfig containing SDK configurations.

    ```php
    /*
    * By default, the SDK creates the SDKConfig instance
    * autoRefreshFields (default value is false)
    * true - all the modules' fields will be auto-refreshed in the background, every hour.
    * false - the fields will not be auto-refreshed in the background. The user can manually delete the file(s) or refresh the fields using methods from ModuleFieldsHandler(com\zoho\crm\api\util\ModuleFieldsHandler)
    *
    * pickListValidation (default value is true)
    * A boolean field that validates user input for a pick list field and allows or disallows the addition of a new value to the list.
    * true - the SDK validates the input. If the value does not exist in the pick list, the SDK throws an error.
    * false - the SDK does not validate the input and makes the API request with the user’s input to the pick list
    *
    * enableSSLVerification (default value is true)
    * A boolean field to enable or disable curl certificate verification
    * true - the SDK verifies the authenticity of certificate
    * false - the SDK skips the verification
    */
    $autoRefreshFields = false;
    $pickListValidation = false;
    $enableSSLVerification = true;
    //The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
    $connectionTimeout = 2;
    //The maximum number of seconds to allow cURL functions to execute.
    $timeout = 2;
    $sdkConfig = (new SDKConfigBuilder())
    ->autoRefreshFields($autoRefreshFields)
    ->pickListValidation($pickListValidation)
    ->sslVerification($enableSSLVerification)
    ->connectionTimeout($connectionTimeout)
    ->timeout($timeout)
    ->build();
    ```

- Create an instance of RequestProxy containing the proxy properties of the user.

    ```php
     $requestProxy = (new ProxyBuilder())
     ->host("proxyHost")
     ->port("proxyPort")
     ->user("proxyUser")
     ->password("password")
     ->build();
    ```

- The path containing the absolute directory path to store user specific files containing module fields information.

    ```php
    $resourcePath = "/Documents/phpsdk-application";
    ```

## Initializing the Application

Initialize the SDK using the following code.

```php
<?php
use com\zoho\crm\api\SDKConfigBuilder;use Zoho\Api\Authenticator\OAuthBuilder;use Zoho\Api\Authenticator\Store\DBBuilder;use Zoho\Api\Logger\Levels;use Zoho\Api\Logger\LogBuilder;use Zoho\Crm\DataCenters\UnitedState;use Zoho\Crm\InitializeBuilder;use Zoho\Crm\ProxyBuilder;use Zoho\Crm\UserSignature;
require_once "vendor/autoload.php";

class Initialize
{
  public static function initialize()
  {
    $logger = (new LogBuilder())
    ->level(Levels::INFO)
    ->filePath("/Documents/php_sdk_log.log")
    ->build();
    $user = new UserSignature("abc@zoho.com");
    $environment = UnitedState::PRODUCTION();
    $token = (new OAuthBuilder())
    ->clientId("clientId")
    ->clientSecret("clientSecret")
    ->grantToken("grantToken")
    ->redirectURL("redirectURL")
    ->build();
    $tokenstore = (new DBBuilder())
    ->host("hostName")
    ->databaseName("dataBaseName")
    ->userName("userName")
    ->password("password")
    ->portNumber("portNumber")
    ->tableName("tableName")
    ->build();
    $autoRefreshFields = false;
    $pickListValidation = false;
    $connectionTimeout = 2;//The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
    $timeout = 2;//The maximum number of seconds to allow cURL functions to execute.
    $sdkConfig = (new SDKConfigBuilder())
    ->autoRefreshFields($autoRefreshFields)
    ->pickListValidation($pickListValidation)
    ->sslVerification($enableSSLVerification)
    ->connectionTimeout($connectionTimeout)
    ->timeout($timeout)
    ->build();
    $resourcePath = "/Documents/phpsdk-application";
    $requestProxy = (new ProxyBuilder())
    ->host("proxyHost")
    ->port("proxyPort")
    ->user("proxyUser")
    ->password("password")
    ->build();
    (new InitializeBuilder())
    ->user($user)
    ->environment($environment)
    ->token($token)
    ->store($tokenstore)
    ->SDKConfig($configInstance)
    ->resourcePath($resourcePath)
    ->logger($logger)
    ->requestProxy($requestProxy)
    ->initialize();
  }
}
?>
```

- You can now access the functionalities of the SDK. Refer to the sample codes to make various API calls through the SDK.

## Class Hierarchy

![classdiagram](class_hierarchy.png)

## Responses and Exceptions

All SDK method calls return an instance of the **APIResponse** class.

Use the **getObject()** method in the returned **APIResponse** object to obtain the response handler interface depending on the type of request (**GET, POST,PUT,DELETE**).

**APIResponse&lt;ResponseHandler&gt;** and **APIResponse&lt;ActionHandler&gt;** are the common wrapper objects for Zoho CRM APIs’ responses.

Whenever the API returns an error response, the response will be an instance of **APIException** class.

All other exceptions such as SDK anomalies and other unexpected behaviours are thrown under the **SDKException** class.

- For operations involving records in Tags
  - **APIResponse&lt;RecordActionHandler&gt;**

- For getting Record Count for a specific Tag operation

  - **APIResponse&lt;CountHandler&gt;**

- For operations involving BaseCurrency

  - **APIResponse&lt;BaseCurrencyActionHandler&gt;**

- For Lead convert operation

  - **APIResponse&lt;ConvertActionHandler&gt;**

- For retrieving Deleted records operation

  - **APIResponse&lt;DeletedRecordsHandler&gt;**

- For Record image download operation

  - **APIResponse&lt;DownloadHandler&gt;**

- For MassUpdate record operations

  - **APIResponse&lt;MassUpdateActionHandler&gt;**

  - **APIResponse&lt;MassUpdateResponseHandler&gt;**

### GET Requests

- The **getObject()** of the returned APIResponse instance returns the response handler interface.

- The **ResponseHandler interface** encompasses the following
  - **ResponseWrapper class** (for **application/json** responses)
  - **FileBodyWrapper class** (for File download responses)
  - **APIException class**

- The **CountHandler interface** encompasses the following
  - **CountWrapper class** (for **application/json** responses)
  - **APIException class**

- The **DeletedRecordsHandler interface** encompasses the following
  - **DeletedRecordsWrapper class** (for **application/json** responses)
  - **APIException class**

- The **DownloadHandler interface** encompasses the following
  - **FileBodyWrapper class** (for File download responses)
  - **APIException class**

- The **MassUpdateResponseHandler interface** encompasses the following
  - **MassUpdateResponseWrapper class** (for **application/json** responses)
  - **APIException class**

### POST, PUT, DELETE Requests

- The **getObject()** of the returned APIResponse instance returns the action handler interface.

- The **ActionHandler interface** encompasses the following
  - **ActionWrapper class** (for **application/json** responses)
  - **APIException class**

- The **ActionWrapper class** contains **Property/Properties** that may contain one/list of **ActionResponse interfaces**.

- The **ActionResponse interface** encompasses following
  - **SuccessResponse class** (for **application/json** responses)
  - **APIException class**

- The **ActionHandler interface** encompasses following
  - **ActionWrapper class** (for **application/json** responses)
  - **APIException class**

- The **RecordActionHandler interface** encompasses following
  - **RecordActionWrapper class** (for **application/json** responses)
  - **APIException class**

- The **BaseCurrencyActionHandler interface** encompasses following
  - **BaseCurrencyActionWrapper class** (for **application/json** responses)
  - **APIException class**

- The **MassUpdateActionHandler interface** encompasses following
  - **MassUpdateActionWrapper class** (for **application/json** responses)
  - **APIException class**

- The **ConvertActionHandler interface** encompasses following
  - **ConvertActionWrapper class** (for **application/json** responses)
  - **APIException class**

## Multi-User support in the PHP SDK

The **PHP SDK** supports both single user and a multi-user app.

### Multi-user App

In the PHP SDK, multi-user functionality is achieved using the **switchUser()**method. To use this method, you need to provide the user, environment, token, and SDK configuration details.

Please note that only one user can send requests at a time. If another user need to send requests, the **switchUser()** method must be used prior to sending the requests.

```php
  (new InitializeBuilder())
  ->user($user)
  ->environment($environment)
  ->token($token)
  ->SDKConfig($configInstance)
  ->switchUser();
```

To Remove a user's configuration in SDK. Use the below code

```php
  Initializer::removeUserConfiguration($user, $environment);
```

```php
<?php
use com\zoho\crm\api\record\GetRecordsHeader;use com\zoho\crm\api\record\RecordOperations;use Zoho\Api\Authenticator\OAuthBuilder;use Zoho\Crm\DataCenters\Europ;use Zoho\Crm\DataCenters\UnitedState;use Zoho\Crm\HeaderMap;use Zoho\Crm\InitializeBuilder;use Zoho\Crm\ParameterMap;use Zoho\Crm\UserSignature;
require_once 'vendor/autoload.php';

class MultiUser
{
  public function main()
  {
    $environment1 = UnitedState::PRODUCTION();
    $user1 = new UserSignature("abc1@zoho.com");
    $token1 = (new OAuthBuilder())
    ->clientId("clientId")
    ->clientSecret("clientSecret")
    ->grantToken("grantToken")
    ->redirectURL("redirectURL")
    ->build();
    (new InitializeBuilder())
    ->user($user1)
    ->environment($environment1)
    ->token($token1)
    ->initialize();
    $this->getRecords("Leads");

    $environment2 = Europ::PRODUCTION();
    $user2 = new UserSignature("abc2@zoho.eu");
    $token2 = (new OAuthBuilder())
    ->clientId("clientId2")
    ->clientSecret("clientSecret2")
    ->refreshToken("refreshToken2")
    ->redirectURL("redirectURL2")
    ->build();
    // Initializer::removeUserConfiguration($user1, $environment1);

    (new InitializeBuilder())
    ->user($user2)
    ->environment($environment2)
    ->token($token2)
    ->switchUser();
    $this->getRecords("Contacts");
  }

  public function getRecords($moduleAPIName)
  {
    try
    {
      $recordOperations = new RecordOperations();
      $paramInstance = new ParameterMap();
      $paramInstance->add(GetRecordsParam::approved(), "false");
      $headerInstance = new HeaderMap();
      $ifmodifiedsince = date_create("2020-06-02T11:03:06+05:30")->setTimezone(new \DateTimeZone(date_default_timezone_get()));
      $headerInstance->add(GetRecordsHeader::IfModifiedSince(), $ifmodifiedsince);
      $response = $recordOperations->getRecords($moduleAPIName,$paramInstance, $headerInstance);
      echo($response->getStatusCode() . "\n");
      print_r($response->getObject());
      echo("\n");
    }
    catch (\Exception $e)
    {
      print_r($e);
    }
  }
}
$obj = new MultiUser();
$obj->main();
?>
```

- The program execution starts from main().

- The details of **"user1"** are is given in the variables user1, token1, environment1.

- Similarly, the details of another user **"user2"** is given in the variables user2, token2, environment2.

- Then, the **switchUser()** function is used to switch between the **"user1"** and **"user2"** as required.

- Based on the latest switched user, the **$this->getRecords($moduleAPIName)** will fetch record.

## SDK Sample code

```php
<?php
use com\zoho\crm\api\record\GetRecordsHeader;use com\zoho\crm\api\record\GetRecordsParam;use com\zoho\crm\api\record\RecordOperations;use com\zoho\crm\api\record\ResponseWrapper;use Zoho\Api\Authenticator\OAuthBuilder;use Zoho\Crm\DataCenters\UnitedState;use Zoho\Crm\HeaderMap;use Zoho\Crm\InitializeBuilder;use Zoho\Crm\ParameterMap;use Zoho\Crm\UserSignature;
require_once 'vendor/autoload.php';

class Record
{
  public function initialize()
  {
    $user = new UserSignature("abc@zoho.com");
    $environment = UnitedState::PRODUCTION();
    $token = (new OAuthBuilder())
    ->clientId("clientId")
    ->clientSecret("clientSecret")
    ->refreshToken("refreshToken")
    ->redirectURL("redirectURL")
    ->build();
    (new InitializeBuilder())
    ->user($user)
    ->environment($environment)
    ->token($token)
    ->initialize();
  }

  public function getRecord()
  {
    try
    {
      $recordOperations = new RecordOperations();
      $paramInstance = new ParameterMap();
      $paramInstance->add(GetRecordsParam::approved(), "both");
      $headerInstance = new HeaderMap();
      $ifmodifiedsince = date_create("2020-06-02T11:03:06+05:30")->setTimezone(new \DateTimeZone(date_default_timezone_get()));
      $headerInstance->add(GetRecordsHeader::IfModifiedSince(), $ifmodifiedsince);
      $moduleAPIName = "Leads";
      $response = $recordOperations->getRecords($moduleAPIName, $paramInstance, $headerInstance);
      if($response != null)
      {
        echo("Status Code: " . $response->getStatusCode() . "\n");
        $responseHandler = $response->getObject();
        if($responseHandler instanceof ResponseWrapper)
        {
          $responseWrapper = $responseHandler;
          $records = $responseWrapper->getData();
          if($records != null)
          {
            $recordClass = 'com\zoho\crm\api\record\Record';
            foreach($records as $record)
            {
              echo("Record ID: " . $record->getId() . "\n");
              $createdBy = $record->getCreatedBy();
              if($createdBy != null)
              {
                echo("Record Created By User-ID: " . $createdBy->getId() . "\n");
                echo("Record Created By User-Name: " . $createdBy->getName() . "\n");
                echo("Record Created By User-Email: " . $createdBy->getEmail() . "\n");
              }
              echo("Record CreatedTime: ");
              print_r($record->getCreatedTime());
              echo("\n");
              $modifiedBy = $record->getModifiedBy();
              if($modifiedBy != null)
              {
                echo("Record Modified By User-ID: " . $modifiedBy->getId() . "\n");
                echo("Record Modified By User-Name: " . $modifiedBy->getName() . "\n");
                echo("Record Modified By User-Email: " . $modifiedBy->getEmail() . "\n");
              }
              echo("Record ModifiedTime: ");
              print_r($record->getModifiedTime());
              print_r("\n");
              $tags = $record->getTag();
              if($tags != null)
              {
                foreach($tags as $tag)
                {
                  echo("Record Tag Name: " . $tag->getName() . "\n");
                  echo("Record Tag ID: " . $tag->getId() . "\n");
                }
              }
              echo("Record Field Value: " . $record->getKeyValue("Last_Name") . "\n");
              echo("Record KeyValues : \n" );
              foreach($record->getKeyValues() as $keyName => $value)
              {
                echo("Field APIName" . $keyName . " \tValue : ");

                print_r($value);

                echo("\n");
              }
            }
          }
        }
      }
    }
    catch (\Exception $e)
    {
      print_r($e);
    }
  }
}

$obj = new Record();
$obj->initialize();
$obj->getRecord();
?>
```
