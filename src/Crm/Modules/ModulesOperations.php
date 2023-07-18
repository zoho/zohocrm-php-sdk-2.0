<?php
namespace Zoho\Crm\Modules;

use Zoho\Crm\HeaderMap;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class ModulesOperations
{

	/**
	 * The method to get modules
	 * @param HeaderMap $headerInstance An instance of HeaderMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getModules(HeaderMap $headerInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/modules');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->setHeader($headerInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to get module
	 * @param string $apiName A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getModule(string $apiName)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/modules/');
		$apiPath=$apiPath.(strval($apiName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to update module by api name
	 * @param string $apiName A string
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateModuleByAPIName(string $apiName, BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/modules/');
		$apiPath=$apiPath.(strval($apiName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to update module by id
	 * @param string $id A string
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateModuleById(string $id, BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/modules/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}
}
