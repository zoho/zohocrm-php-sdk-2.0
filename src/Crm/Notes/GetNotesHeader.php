<?php
namespace Zoho\Crm\Notes;

use Zoho\Crm\Header;

class GetNotesHeader
{

	public static final function IfModifiedSince()
	{
		return new Header('If-Modified-Since', 'com.zoho.crm.api.Notes.GetNotesHeader');

	}
}
