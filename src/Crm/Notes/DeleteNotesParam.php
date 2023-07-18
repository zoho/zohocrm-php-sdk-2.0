<?php
namespace Zoho\Crm\Notes;

use Zoho\Crm\Param;

class DeleteNotesParam
{

	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.Notes.DeleteNotesParam');

	}
}
