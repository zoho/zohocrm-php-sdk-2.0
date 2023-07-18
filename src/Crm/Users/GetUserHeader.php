<?php
namespace Zoho\Crm\Users;

use Zoho\Crm\Header;

class GetUserHeader
{

	public static final function IfModifiedSince()
	{
		return new Header('If-Modified-Since', 'com.zoho.crm.api.Users.GetUserHeader');

	}
}
