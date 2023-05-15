<?php
namespace Zoho\Crm\RelatedRecords;

use Zoho\Crm\Header;

class GetRelatedRecordHeader
{

	public static final function IfModifiedSince()
	{
		return new Header('If-Modified-Since', 'com.zoho.crm.api.RelatedRecords.GetRelatedRecordHeader');

	}
}
