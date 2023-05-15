<?php
namespace Zoho\Crm\Records;

use Zoho\Crm\Header;

class CreateRecordsHeader
{

	public static final function XEXTERNAL()
	{
		return new Header('X-EXTERNAL', 'com.zoho.crm.api.Record.CreateRecordsHeader');

	}
}
