<?php
namespace com\zoho\crm\api\fields;

use Zoho\Crm\Param;

class GetFieldsParam
{

	public static final function type()
	{
		return new Param('type', 'com.zoho.crm.api.Fields.GetFieldsParam');

	}
}
