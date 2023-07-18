<?php
namespace Zoho\Crm\Fields;

use Zoho\Crm\Param;
use Zoho\Crm\ParameterMap;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class FieldsOperations
{

	private  $module;

	/**
	 * Creates an instance of FieldsOperations with the given parameters
	 * @param string $module A string
	 */
	public function __Construct(string $module=null)
	{
		$this->module=$module;

	}

	/**
	 * The method to get fields
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getFields(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/fields');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addParam(new Param('module', 'com.zoho.crm.api.Fields.GetFieldsParam'), $this->module);
		$handlerInstance->setParam($paramInstance);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to get field
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getField(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/fields/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addParam(new Param('module', 'com.zoho.crm.api.Fields.GetFieldParam'), $this->module);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}
}
