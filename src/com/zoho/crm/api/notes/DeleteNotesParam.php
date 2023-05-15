<?php
namespace com\zoho\crm\api\notes;

use Zoho\Crm\Param;

class DeleteNotesParam
{

	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.Notes.DeleteNotesParam');

	}
}
