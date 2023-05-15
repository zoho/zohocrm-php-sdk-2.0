<?php
namespace Zoho\Crm\ContractRoles;

use Zoho\Crm\Param;

class GetAllContactRolesOfDealParam
{

	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.ContactRoles.GetAllContactRolesOfDealParam');

	}
}
