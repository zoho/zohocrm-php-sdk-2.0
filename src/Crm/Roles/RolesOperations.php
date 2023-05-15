<?php
namespace Zoho\Crm\Roles;

use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class RolesOperations
{

	/**
	 * The method to get roles
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRoles()
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/roles');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to get role
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRole(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/roles/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}
}
