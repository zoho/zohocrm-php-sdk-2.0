<?php
namespace com\zoho\crm\api\dc;

use com\zoho\crm\api\dc\DataCenter;

/**
 * This class represents the properties of Zoho CRM in CN Domain.
 */
class CNDataCenter extends DataCenter
{
    private static $PRODUCTION = null;

    private static $SANDBOX = null;

    private static $DEVELOPER = null;

    private static $CN = null;

    /**
     * This Environment class instance represents the Zoho CRM Production Environment in CN Domain.
     * @return Environment A Environment class instance.
     */
    public static function PRODUCTION()
    {
        self::$CN = new CNDataCenter();

        if (self::$PRODUCTION == null)
        {
            self::$PRODUCTION = DataCenter::setEnvironment("https://www.zohoapis.com.cn", self::$CN->getIAMUrl(), self::$CN->getFileUploadUrl(), "cn_prd");
        }

        return self::$PRODUCTION;
    }

    /**
     * This Environment class instance represents the Zoho CRM Sandbox Environment in CN Domain.
     * @return Environment A Environment class instance.
     */
    public static function SANDBOX()
    {
        self::$CN = new CNDataCenter();

        if (self::$SANDBOX == null)
        {
            self::$SANDBOX = DataCenter::setEnvironment("https://sandbox.zohoapis.com.cn", self::$CN->getIAMUrl(), self::$CN->getFileUploadUrl(), "cn_sdb");
        }

        return self::$SANDBOX;
    }

    /**
     * This Environment class instance represents the Zoho CRM Developer Environment in CN Domain.
     * @return Environment A Environment class instance.
     */
    public static function DEVELOPER()
    {
        self::$CN = new CNDataCenter();

        if (self::$DEVELOPER == null)
        {
            self::$DEVELOPER = DataCenter::setEnvironment("https://developer.zohoapis.com.cn", self::$CN->getIAMUrl(), self::$CN->getFileUploadUrl(), "cn_dev");
        }

        return self::$DEVELOPER;
    }

    public function getIAMUrl()
    {
        return "https://accounts.zoho.com.cn/oauth/v2/token";
    }

    public function getFileUploadUrl()
    {
        return "https://content.zohoapis.com.cn";
    }
}