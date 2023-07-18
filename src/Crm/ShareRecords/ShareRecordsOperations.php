<?php
namespace Zoho\Crm\ShareRecords;

use Zoho\Crm\ParameterMap;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class ShareRecordsOperations
{

	private  $moduleAPIName;
	private  $recordId;

	/**
	 * Creates an instance of ShareRecordsOperations with the given parameters
	 * @param string $recordId A string
	 * @param string $moduleAPIName A string
	 */
	public function __Construct(string $recordId, string $moduleAPIName)
	{
		$this->recordId=$recordId;
		$this->moduleAPIName=$moduleAPIName;

	}

	/**
	 * The method to get shared record details
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getSharedRecordDetails(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/actions/share');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to share record
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function shareRecord(BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/actions/share');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->setMandatoryChecker(true);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to update share permissions
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateSharePermissions(BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/actions/share');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->setMandatoryChecker(true);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to revoke shared record
	 * @return APIResponse An instance of APIResponse
	 */
	public  function revokeSharedRecord()
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->recordId));
		$apiPath=$apiPath.('/actions/share');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		return $handlerInstance->apiCall(DeleteActionHandler::class, 'application/json');

	}
}
