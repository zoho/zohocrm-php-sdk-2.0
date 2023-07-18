<?php
namespace Zoho\Crm\File;

use Zoho\Crm\Param;

class UploadFilesParam
{

	public static final function type()
	{
		return new Param('type', 'com.zoho.crm.api.File.UploadFilesParam');

	}
}
