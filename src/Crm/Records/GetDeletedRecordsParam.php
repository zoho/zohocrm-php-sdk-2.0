<?php
namespace Zoho\Crm\Records;

use Zoho\Crm\Param;

class GetDeletedRecordsParam
{

	public static final function type()
	{
		return new Param('type', 'com.zoho.crm.api.Record.GetDeletedRecordsParam');

	}
	public static final function page()
	{
		return new Param('page', 'com.zoho.crm.api.Record.GetDeletedRecordsParam');

	}
	public static final function perPage()
	{
		return new Param('per_page', 'com.zoho.crm.api.Record.GetDeletedRecordsParam');

	}
}
