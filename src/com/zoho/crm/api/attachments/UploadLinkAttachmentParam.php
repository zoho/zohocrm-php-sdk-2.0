<?php
namespace com\zoho\crm\api\attachments;

use Zoho\Crm\Param;

class UploadLinkAttachmentParam
{

	public static final function attachmentUrl()
	{
		return new Param('attachmentUrl', 'com.zoho.crm.api.Attachments.UploadLinkAttachmentParam');

	}
}
