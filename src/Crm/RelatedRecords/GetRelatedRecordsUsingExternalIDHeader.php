<?php
namespace Zoho\Crm\RelatedRecords;

use Zoho\Crm\Header;

class GetRelatedRecordsUsingExternalIDHeader
{

	public static final function IfModifiedSince()
	{
		return new Header('If-Modified-Since', 'com.zoho.crm.api.RelatedRecords.GetRelatedRecordsUsingExternalIDHeader');

	}
}
