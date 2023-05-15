<?php
namespace Zoho\Crm\Notes;

use Zoho\Crm\Param;

class GetNoteParam
{

	public static final function fields()
	{
		return new Param('fields', 'com.zoho.crm.api.Notes.GetNoteParam');

	}
}
