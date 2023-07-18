<?php
namespace Zoho\Crm\Notes;

use Zoho\Crm\Param;

class GetNotesParam
{

	public static final function page()
	{
		return new Param('page', 'com.zoho.crm.api.Notes.GetNotesParam');

	}
	public static final function perPage()
	{
		return new Param('per_page', 'com.zoho.crm.api.Notes.GetNotesParam');

	}
	public static final function fields()
	{
		return new Param('fields', 'com.zoho.crm.api.Notes.GetNotesParam');

	}
}
