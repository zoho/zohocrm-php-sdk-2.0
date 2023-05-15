<?php
namespace Zoho\Crm\Attachments;

use Zoho\Crm\Param;

class DeleteAttachmentsParam
{

	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.Attachments.DeleteAttachmentsParam');

	}
}
