<?php
namespace Zoho\Crm\RelatedRecords;

use Zoho\Crm\Header;
use Zoho\Crm\HeaderMap;
use Zoho\Crm\ParameterMap;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;
use Zoho\Crm\Util\Utility;

class RelatedRecordsOperations
{

	private  $moduleAPIName;
	private  $relatedListAPIName;
	private  $xExternal;

	/**
	 * Creates an instance of RelatedRecordsOperations with the given parameters
	 * @param string $relatedListAPIName A string
	 * @param string $moduleAPIName A string
	 * @param string $xExternal A string
	 */
	public function __Construct(string $relatedListAPIName, string $moduleAPIName, string $xExternal=null)
	{
		$this->relatedListAPIName=$relatedListAPIName;
		$this->moduleAPIName=$moduleAPIName;
		$this->xExternal=$xExternal;

	}

	/**
	 * The method to get related records
	 * @param string $recordId A string
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @param HeaderMap $headerInstance An instance of HeaderMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedRecords(string $recordId, ParameterMap $paramInstance=null, HeaderMap $headerInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($recordId));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.GetRelatedRecordsHeader'), $this->xExternal);
		$handlerInstance->setParam($paramInstance);
		$handlerInstance->setHeader($headerInstance);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to update related records
	 * @param string $recordId A string
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateRelatedRecords(string $recordId, BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($recordId));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.UpdateRelatedRecordsHeader'), $this->xExternal);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to delink records
	 * @param string $recordId A string
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function delinkRecords(string $recordId, ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($recordId));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.DelinkRecordsHeader'), $this->xExternal);
		$handlerInstance->setParam($paramInstance);
		Utility::getFields($this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to get related records using external id
	 * @param string $externalValue A string
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @param HeaderMap $headerInstance An instance of HeaderMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedRecordsUsingExternalId(string $externalValue, ParameterMap $paramInstance=null, HeaderMap $headerInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($externalValue));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.GetRelatedRecordsUsingExternalIDHeader'), $this->xExternal);
		$handlerInstance->setParam($paramInstance);
		$handlerInstance->setHeader($headerInstance);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to update related records using external id
	 * @param string $externalValue A string
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateRelatedRecordsUsingExternalId(string $externalValue, BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($externalValue));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.UpdateRelatedRecordsUsingExternalIDHeader'), $this->xExternal);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to delete related records using external id
	 * @param string $externalValue A string
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function deleteRelatedRecordsUsingExternalId(string $externalValue, ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($externalValue));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.DeleteRelatedRecordsUsingExternalIDHeader'), $this->xExternal);
		$handlerInstance->setParam($paramInstance);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to get related record
	 * @param string $relatedRecordId A string
	 * @param string $recordId A string
	 * @param HeaderMap $headerInstance An instance of HeaderMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedRecord(string $relatedRecordId, string $recordId, HeaderMap $headerInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($recordId));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($relatedRecordId));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.GetRelatedRecordHeader'), $this->xExternal);
		$handlerInstance->setHeader($headerInstance);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to update related record
	 * @param string $relatedRecordId A string
	 * @param string $recordId A string
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateRelatedRecord(string $relatedRecordId, string $recordId, BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($recordId));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($relatedRecordId));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.UpdateRelatedRecordHeader'), $this->xExternal);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to delink record
	 * @param string $relatedRecordId A string
	 * @param string $recordId A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function delinkRecord(string $relatedRecordId, string $recordId)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($recordId));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($relatedRecordId));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.DelinkRecordHeader'), $this->xExternal);
		Utility::getFields($this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to get related record using external id
	 * @param string $externalFieldValue A string
	 * @param string $externalValue A string
	 * @param HeaderMap $headerInstance An instance of HeaderMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedRecordUsingExternalId(string $externalFieldValue, string $externalValue, HeaderMap $headerInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($externalValue));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($externalFieldValue));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.GetRelatedRecordUsingExternalIDHeader'), $this->xExternal);
		$handlerInstance->setHeader($headerInstance);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to update related record using external id
	 * @param string $externalFieldValue A string
	 * @param string $externalValue A string
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateRelatedRecordUsingExternalId(string $externalFieldValue, string $externalValue, BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($externalValue));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($externalFieldValue));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE);
		$handlerInstance->setContentType('application/json');
		$handlerInstance->setRequest($request);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.UpdateRelatedRecordUsingExternalIDHeader'), $this->xExternal);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}

	/**
	 * The method to delete related record using external id
	 * @param string $externalFieldValue A string
	 * @param string $externalValue A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function deleteRelatedRecordUsingExternalId(string $externalFieldValue, string $externalValue)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/');
		$apiPath=$apiPath.(strval($this->moduleAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($externalValue));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($this->relatedListAPIName));
		$apiPath=$apiPath.('/');
		$apiPath=$apiPath.(strval($externalFieldValue));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE);
		$handlerInstance->addHeader(new Header('X-EXTERNAL', 'com.zoho.crm.api.RelatedRecords.DeleteRelatedRecordUsingExternalIDHeader'), $this->xExternal);
		Utility::getRelatedLists($this->relatedListAPIName, $this->moduleAPIName, $handlerInstance);
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json');

	}
}
