<?php
namespace com\zoho\crm\api\dc;

use com\zoho\crm\api\dc\DataCenter;

/**
 * This class represents the properties of Zoho CRM in US Domain.
 */
class USDataCenter extends DataCenter
{
    private static $PRODUCTION = null;

    private static $SANDBOX = null;

    private static $DEVELOPER = null;

    private static $US = null;

    /**
     * This Environment class instance represents the Zoho CRM Production Environment in US Domain.
     * @return Environment A Environment class instance.
     */
    public static function PRODUCTION()
    {
        self::$US = new USDataCenter();

        if (self::$PRODUCTION == null)
        {
            self::$PRODUCTION = DataCenter::setEnvironment("https://www.zohoapis.com", self::$US->getIAMUrl(), self::$US->getFileUploadUrl(), "us_prd");
        }

        return self::$PRODUCTION;
    }

    /**
     * This Environment class instance represents the Zoho CRM Sandbox Environment in US Domain.
     * @return Environment A Environment class instance.
     */
    public static function SANDBOX()
    {
        self::$US = new USDataCenter();

        if (self::$SANDBOX == null)
        {
            self::$SANDBOX = DataCenter::setEnvironment("https://sandbox.zohoapis.com", self::$US->getIAMUrl(), self::$US->getFileUploadUrl(), "us_sdb");
        }

        return self::$SANDBOX;
    }

    /**
     * This Environment class instance represents the Zoho CRM Developer Environment in US Domain.
     * @return Environment A Environment class instance.
     */
    public static function DEVELOPER()
    {
        self::$US = new USDataCenter();

        if (self::$DEVELOPER == null)
        {
            self::$DEVELOPER = DataCenter::setEnvironment("https://developer.zohoapis.com", self::$US->getIAMUrl(), self::$US->getFileUploadUrl(), "us_dev");
        }

        return self::$DEVELOPER;
    }

    public function getIAMUrl()
    {
        return "https://accounts.zoho.com/oauth/v2/token";
    }

    public function getFileUploadUrl()
    {
        return "https://content.zohoapis.com";
    }
}