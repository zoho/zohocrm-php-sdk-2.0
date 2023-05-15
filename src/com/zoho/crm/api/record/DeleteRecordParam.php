<?php
namespace com\zoho\crm\api\record;

use Zoho\Crm\Param;

class DeleteRecordParam
{

	public static final function wfTrigger()
	{
		return new Param('wf_trigger', 'com.zoho.crm.api.Record.DeleteRecordParam');

	}
}
