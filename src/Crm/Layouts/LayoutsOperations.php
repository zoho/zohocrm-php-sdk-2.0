<?php
namespace Zoho\Crm\Layouts;

use Zoho\Crm\Param;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class LayoutsOperations
{

	private  $module;

	/**
	 * Creates an instance of LayoutsOperations with the given parameters
	 * @param string $module A string
	 */
	public function __Construct(string $module=null)
	{
		$this->module=$module;

	}

	/**
	 * The method to get layouts
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getLayouts()
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/layouts');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addParam(new Param('module', 'com.zoho.crm.api.Layouts.GetLayoutsParam'), $this->module);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to get layout
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getLayout(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/layouts/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addParam(new Param('module', 'com.zoho.crm.api.Layouts.GetLayoutParam'), $this->module);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}
}
