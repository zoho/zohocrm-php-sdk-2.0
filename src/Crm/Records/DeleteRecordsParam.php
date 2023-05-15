<?php
namespace Zoho\Crm\Records;

use Zoho\Crm\Param;

class DeleteRecordsParam
{

	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.Record.DeleteRecordsParam');

	}
	public static final function wfTrigger()
	{
		return new Param('wf_trigger', 'com.zoho.crm.api.Record.DeleteRecordsParam');

	}
}
