<?php
namespace Zoho\Crm\RelatedRecords;

use Zoho\Crm\Param;

class GetRelatedRecordsUsingExternalIDParam
{

	public static final function page()
	{
		return new Param('page', 'com.zoho.crm.api.RelatedRecords.GetRelatedRecordsUsingExternalIDParam');

	}
	public static final function perPage()
	{
		return new Param('per_page', 'com.zoho.crm.api.RelatedRecords.GetRelatedRecordsUsingExternalIDParam');

	}
}
