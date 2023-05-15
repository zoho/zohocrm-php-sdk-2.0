<?php
namespace com\zoho\crm\api\bulkwrite;

use Zoho\Crm\Header;

class UploadFileHeader
{

	public static final function feature()
	{
		return new Header('feature', 'com.zoho.crm.api.BulkWrite.UploadFileHeader');

	}
	public static final function XCRMORG()
	{
		return new Header('X-CRM-ORG', 'com.zoho.crm.api.BulkWrite.UploadFileHeader');

	}
}
