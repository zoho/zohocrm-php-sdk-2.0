<?php
namespace Zoho\Crm\Profiles;

use Zoho\Crm\Header;
use Zoho\Crm\Util\APIResponse;
use Zoho\Crm\Util\CommonAPIHandler;
use Zoho\Crm\Util\Constants;

class ProfilesOperations
{

	private  $ifModifiedSince;

	/**
	 * Creates an instance of ProfilesOperations with the given parameters
	 * @param \DateTime $ifModifiedSince An instance of \DateTime
	 */
	public function __Construct(\DateTime $ifModifiedSince=null)
	{
		$this->ifModifiedSince=$ifModifiedSince;

	}

	/**
	 * The method to get profiles
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getProfiles()
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/profiles');
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addHeader(new Header('If-Modified-Since', 'com.zoho.crm.api.Profiles.GetProfilesHeader'), $this->ifModifiedSince);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}

	/**
	 * The method to get profile
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getProfile(string $id)
	{
		$handlerInstance=new CommonAPIHandler();
		$apiPath="";
		$apiPath=$apiPath.('/crm/v2/settings/profiles/');
		$apiPath=$apiPath.(strval($id));
		$handlerInstance->setAPIPath($apiPath);
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET);
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ);
		$handlerInstance->addHeader(new Header('If-Modified-Since', 'com.zoho.crm.api.Profiles.GetProfileHeader'), $this->ifModifiedSince);
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json');

	}
}
