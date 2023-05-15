<?php
namespace Zoho\Crm\ShareRecords;

use Zoho\Crm\Param;

class GetSharedRecordDetailsParam
{

	public static final function sharedTo()
	{
		return new Param('sharedTo', 'com.zoho.crm.api.ShareRecords.GetSharedRecordDetailsParam');

	}
	public static final function view()
	{
		return new Param('view', 'com.zoho.crm.api.ShareRecords.GetSharedRecordDetailsParam');

	}
}
