<?php
namespace Zoho\Crm\RelatedRecords;

use Zoho\Crm\Param;

class DeleteRelatedRecordsUsingExternalIDParam
{

	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.RelatedRecords.DeleteRelatedRecordsUsingExternalIDParam');

	}
}
