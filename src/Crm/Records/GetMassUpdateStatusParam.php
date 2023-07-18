<?php
namespace Zoho\Crm\Records;

use Zoho\Crm\Param;

class GetMassUpdateStatusParam
{

	public static final function jobId()
	{
		return new Param('job_id', 'com.zoho.crm.api.Record.GetMassUpdateStatusParam');

	}
}
