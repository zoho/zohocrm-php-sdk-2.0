<?php
namespace Zoho\Crm\Territories;

use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class TerritoriesOperations
{

	/**
	 * The method to get territories
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getTerritories()
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/territories');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to get territory
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getTerritory(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/territories/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}
}
