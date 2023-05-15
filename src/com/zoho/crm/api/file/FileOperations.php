<?php
namespace com\zoho\crm\api\file;

use Zoho\Crm\ParameterMap;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class FileOperations
{

	/**
	 * The method to upload files
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function uploadFiles(BodyWrapper $request, ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/files');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE);
		$handlerInstance->setContentType('multipart/form-data');
		$handlerInstance->setRequest($request);
		$handlerInstance->setMandatoryChecker(true);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to get file
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getFile(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/files');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/x-download');

	}
}
