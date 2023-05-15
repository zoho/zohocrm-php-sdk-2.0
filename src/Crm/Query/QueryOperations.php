<?php
namespace Zoho\Crm\Query;

use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class QueryOperations
{

	/**
	 * The method to get records
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRecords(BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/coql');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->setMandatoryChecker(true);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}
}
