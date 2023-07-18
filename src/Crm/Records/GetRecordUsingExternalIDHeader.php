<?php
namespace Zoho\Crm\Records;

use Zoho\Crm\Header;

class GetRecordUsingExternalIDHeader
{

	public static final function IfModifiedSince()
	{
		return new Header('If-Modified-Since', 'com.zoho.crm.api.Record.GetRecordUsingExternalIDHeader');

	}
	public static final function XEXTERNAL()
	{
		return new Header('X-EXTERNAL', 'com.zoho.crm.api.Record.GetRecordUsingExternalIDHeader');

	}
}
