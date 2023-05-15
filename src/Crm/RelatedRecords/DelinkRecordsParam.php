<?php
namespace Zoho\Crm\RelatedRecords;

use Zoho\Crm\Param;

class DelinkRecordsParam
{

	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.RelatedRecords.DelinkRecordsParam');

	}
}
