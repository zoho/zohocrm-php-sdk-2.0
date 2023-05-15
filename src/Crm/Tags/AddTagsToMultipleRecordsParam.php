<?php
namespace Zoho\Crm\Tags;

use Zoho\Crm\Param;

class AddTagsToMultipleRecordsParam
{

	public static final function tagNames()
	{
		return new Param('tag_names', 'com.zoho.crm.api.Tags.AddTagsToMultipleRecordsParam');

	}
	public static final function ids()
	{
		return new Param('ids', 'com.zoho.crm.api.Tags.AddTagsToMultipleRecordsParam');

	}
	public static final function overWrite()
	{
		return new Param('over_write', 'com.zoho.crm.api.Tags.AddTagsToMultipleRecordsParam');

	}
}
