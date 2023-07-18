<?php
namespace Zoho\Crm\Taxes;

use Zoho\Crm\ParameterMap;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class TaxesOperations
{

	/**
	 * The method to get taxes
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getTaxes()
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/org/taxes');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to create taxes
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function createTaxes(BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/org/taxes');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->setMandatoryChecker(true);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to update taxes
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateTaxes(BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/org/taxes');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->setMandatoryChecker(true);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to delete taxes
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function deleteTaxes(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/org/taxes');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to get tax
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getTax(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/org/taxes/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to delete tax
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function deleteTax(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/org/taxes/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}
}
