<?php
namespace com\zoho\crm\api\record;

use Zoho\Crm\Header;

class UpdateRecordUsingExternalIDHeader
{

	public static final function XEXTERNAL()
	{
		return new Header('X-EXTERNAL', 'com.zoho.crm.api.Record.UpdateRecordUsingExternalIDHeader');

	}
}
