<?php
namespace Zoho\Crm\Tags;

use Zoho\Crm\Param;

class RemoveTagsFromMultipleRecordsParam
{

	public static final function tagNames()
	{
		return new Param('tag_names', 'com.zoho.crm.api.Tags.RemoveTagsFromMultipleRecordsParam');

	}
	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.Tags.RemoveTagsFromMultipleRecordsParam');

	}
}
