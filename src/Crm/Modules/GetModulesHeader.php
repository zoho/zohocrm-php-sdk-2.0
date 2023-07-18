<?php
namespace Zoho\Crm\Modules;

use Zoho\Crm\Header;

class GetModulesHeader
{

	public static final function IfModifiedSince()
	{
		return new Header('If-Modified-Since', 'com.zoho.crm.api.Modules.GetModulesHeader');

	}
}
