<?php
namespace Zoho\Crm\Notification;

use Zoho\Crm\Param;

class DisableNotificationsParam
{

	public static final function channelIds()
	{
		return new Param('channel_ids', 'com.zoho.crm.api.Notification.DisableNotificationsParam');

	}
}
