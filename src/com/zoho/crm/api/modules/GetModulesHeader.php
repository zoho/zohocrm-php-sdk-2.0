<?php
namespace com\zoho\crm\api\modules;

use Zoho\Crm\Header;

class GetModulesHeader
{

	public static final function IfModifiedSince()
	{
		return new Header('If-Modified-Since', 'com.zoho.crm.api.Modules.GetModulesHeader');

	}
}
