<?php
namespace Zoho\Crm\Records;

use Zoho\Crm\Param;

class SearchRecordsParam
{

	public static final function criteria()
	{
		return new Param('criteria', 'com.zoho.crm.api.Record.SearchRecordsParam');

	}
	public static final function email()
	{
		return new Param('email', 'com.zoho.crm.api.Record.SearchRecordsParam');

	}
	public static final function phone()
	{
		return new Param('phone', 'com.zoho.crm.api.Record.SearchRecordsParam');

	}
	public static final function word()
	{
		return new Param('word', 'com.zoho.crm.api.Record.SearchRecordsParam');

	}
	public static final function converted()
	{
		return new Param('converted', 'com.zoho.crm.api.Record.SearchRecordsParam');

	}
	public static final function approved()
	{
		return new Param('approved', 'com.zoho.crm.api.Record.SearchRecordsParam');

	}
	public static final function page()
	{
		return new Param('page', 'com.zoho.crm.api.Record.SearchRecordsParam');

	}
	public static final function perPage()
	{
		return new Param('per_page', 'com.zoho.crm.api.Record.SearchRecordsParam');

	}
	public static final function fields()
	{
		return new Param('fields', 'com.zoho.crm.api.Record.SearchRecordsParam');

	}
}
