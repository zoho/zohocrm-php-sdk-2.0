<?php
namespace Zoho\Crm\Attachments;

use Zoho\Crm\ParameterMap;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class AttachmentsOperations
{

	private  $recordId;
	private  $moduleAPIName;

	/**
	 * Creates an instance of AttachmentsOperations with the given parameters
	 * @param string $moduleAPIName A string
	 * @param string $recordId A string
	 */
	public function __Construct(string $moduleAPIName, string $recordId)
	{
		$this->moduleAPIName=$moduleAPIName;
		$this->recordId=$recordId;

	}

	/**
	 * The method to download attachment
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function downloadAttachment(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/Attachments/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/x-download');

	}

	/**
	 * The method to delete attachment
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function deleteAttachment(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/Attachments/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to get attachments
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getAttachments(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/Attachments');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to upload attachment
	 * @param FileBodyWrapper $request An instance of FileBodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function uploadAttachment(FileBodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/Attachments');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE);
		$handlerInstance->setContentType('multipart/form-data');
		$handlerInstance->setRequest($request);
		$handlerInstance->setMandatoryChecker(true);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to upload link attachment
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function uploadLinkAttachment(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/Attachments');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE);
		$handlerInstance->setMandatoryChecker(true);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to delete attachments
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function deleteAttachments(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/Attachments');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}
}
