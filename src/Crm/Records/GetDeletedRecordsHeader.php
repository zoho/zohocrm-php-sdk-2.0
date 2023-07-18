<?php
namespace Zoho\Crm\Records;

use Zoho\Crm\Header;

class GetDeletedRecordsHeader
{

	public static final function IfModifiedSince()
	{
		return new Header('If-Modified-Since', 'com.zoho.crm.api.Record.GetDeletedRecordsHeader');

	}
}
