<?php
namespace Zoho\Crm\Records;

use Zoho\Crm\Param;

class DeleteRecordUsingExternalIDParam
{

	public static final function wfTrigger()
	{
		return new Param('wf_trigger', 'com.zoho.crm.api.Record.DeleteRecordUsingExternalIDParam');

	}
}
