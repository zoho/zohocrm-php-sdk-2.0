<?php
namespace Zoho\Crm\Variables;

use Zoho\Crm\ParameterMap;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class VariablesOperations
{

	/**
	 * The method to get variables
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getVariables(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variables');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to create variables
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function createVariables(BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variables');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->setMandatoryChecker(true);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to update variables
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateVariables(BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variables');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->setMandatoryChecker(true);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to delete variables
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function deleteVariables(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variables');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to get variable by id
	 * @param string $id A string
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getVariableById(string $id, ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variables/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to update variable by id
	 * @param string $id A string
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateVariableById(string $id, BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variables/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to delete variable
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function deleteVariable(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variables/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to get variable for api name
	 * @param string $apiName A string
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getVariableForAPIName(string $apiName, ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variables/');
		$apiPath=$apiPath.(strval($apiName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to update variable by api name
	 * @param string $apiName A string
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateVariableByAPIName(string $apiName, BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variables/');
		$apiPath=$apiPath.(strval($apiName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}
}
