<?php
namespace com\zoho\crm\api\record;

use Zoho\Crm\Header;

class UpdateRecordHeader
{

	public static final function XEXTERNAL()
	{
		return new Header('X-EXTERNAL', 'com.zoho.crm.api.Record.UpdateRecordHeader');

	}
}
