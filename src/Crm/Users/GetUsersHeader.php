<?php
namespace Zoho\Crm\Users;

use Zoho\Crm\Header;

class GetUsersHeader
{

	public static final function IfModifiedSince()
	{
		return new Header('If-Modified-Since', 'com.zoho.crm.api.Users.GetUsersHeader');

	}
}
