<?php
namespace Zoho\Crm\Tags;

use Zoho\Crm\Param;

class GetTagsParam
{

	public static final function module()
	{
		return new Param('module', 'com.zoho.crm.api.Tags.GetTagsParam');

	}
	public static final function myTags()
	{
		return new Param('my_tags', 'com.zoho.crm.api.Tags.GetTagsParam');

	}
}
