<?php
namespace com\zoho\crm\api\relatedlists;

use Zoho\Crm\Param;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class RelatedListsOperations
{

	private  $module;

	/**
	 * Creates an instance of RelatedListsOperations with the given parameters
	 * @param string $module A string
	 */
	public function __Construct(string $module=null)
	{
		$this->module=$module;

	}

	/**
	 * The method to get related lists
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedLists()
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/related_lists');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addParam(new Param('module', 'com.zoho.crm.api.RelatedLists.GetRelatedListsParam'), $this->module);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to get related list
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedList(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/related_lists/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addParam(new Param('module', 'com.zoho.crm.api.RelatedLists.GetRelatedListParam'), $this->module);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}
}
