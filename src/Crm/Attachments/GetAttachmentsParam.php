<?php
namespace Zoho\Crm\Attachments;

use Zoho\Crm\Param;

class GetAttachmentsParam
{

	public static final function fields()
	{
		return new Param('fields', 'com.zoho.crm.api.Attachments.GetAttachmentsParam');

	}
	public static final function page()
	{
		return new Param('page', 'com.zoho.crm.api.Attachments.GetAttachmentsParam');

	}
	public static final function perPage()
	{
		return new Param('per_page', 'com.zoho.crm.api.Attachments.GetAttachmentsParam');

	}
}
