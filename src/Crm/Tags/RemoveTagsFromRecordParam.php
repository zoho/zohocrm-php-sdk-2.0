<?php
namespace Zoho\Crm\Tags;

use Zoho\Crm\Param;

class RemoveTagsFromRecordParam
{

	public static final function tagNames()
	{
		return new Param('tag_names', 'com.zoho.crm.api.Tags.RemoveTagsFromRecordParam');

	}
}
