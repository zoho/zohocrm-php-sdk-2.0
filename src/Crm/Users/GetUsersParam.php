<?php
namespace Zoho\Crm\Users;

use Zoho\Crm\Param;

class GetUsersParam
{

	public static final function type()
	{
		return new Param('type', 'com.zoho.crm.api.Users.GetUsersParam');

	}
	public static final function page()
	{
		return new Param('page', 'com.zoho.crm.api.Users.GetUsersParam');

	}
	public static final function perPage()
	{
		return new Param('per_page', 'com.zoho.crm.api.Users.GetUsersParam');

	}
}
