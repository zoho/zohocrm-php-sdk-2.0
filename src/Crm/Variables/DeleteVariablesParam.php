<?php
namespace Zoho\Crm\Variables;

use Zoho\Crm\Param;

class DeleteVariablesParam
{

	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.Variables.DeleteVariablesParam');

	}
}
