<?php
namespace Zoho\Crm\VariableGroups;

use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class VariableGroupsOperations
{

	/**
	 * The method to get variable groups
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getVariableGroups()
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variable_groups');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to get variable group by id
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getVariableGroupById(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variable_groups/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to get variable group by api name
	 * @param string $apiName A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getVariableGroupByAPIName(string $apiName)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/variable_groups/');
		$apiPath=$apiPath.(strval($apiName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}
}
