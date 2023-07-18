<?php
namespace Zoho\Crm\Taxes;

use Zoho\Crm\Param;

class DeleteTaxesParam
{

	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.Taxes.DeleteTaxesParam');

	}
}
