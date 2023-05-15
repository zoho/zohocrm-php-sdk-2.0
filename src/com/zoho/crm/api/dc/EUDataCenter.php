<?php
namespace com\zoho\crm\api\dc;

use com\zoho\crm\api\dc\DataCenter;

/***
 * This class represents the properties of Zoho CRM in EU Domain.
 */
class EUDataCenter extends DataCenter
{
    private static $PRODUCTION = null;

    private static $SANDBOX = null;

    private static $DEVELOPER = null;

    private static $EU = null;

    /**
     * This Environment class instance represents the Zoho CRM Production Environment in EU Domain.
     * @return Environment A Environment class instance.
     */
    public static function PRODUCTION()
    {
        self::$EU = new EUDataCenter();

        if (self::$PRODUCTION == null)
        {
            self::$PRODUCTION = DataCenter::setEnvironment("https://www.zohoapis.eu", self::$EU->getIAMUrl(), self::$EU->getFileUploadUrl(), "eu_prd");
        }

        return self::$PRODUCTION;
    }

    /**
     * This Environment class instance represents the Zoho CRM Sandbox Environment in EU Domain.
     * @return Environment A Environment class instance.
     */
    public static function SANDBOX()
    {
        self::$EU = new EUDataCenter();

        if (self::$SANDBOX == null)
        {
            self::$SANDBOX = DataCenter::setEnvironment("https://sandbox.zohoapis.eu", self::$EU->getIAMUrl(), self::$EU->getFileUploadUrl(), "eu_sdb");
        }

        return self::$SANDBOX;
    }

    /**
     * This Environment class instance represents the Zoho CRM Developer Environment in EU Domain.
     * @return Environment A Environment class instance.
     */
    public static function DEVELOPER()
    {
        self::$EU = new EUDataCenter();

        if (self::$DEVELOPER == null)
        {
            self::$DEVELOPER = DataCenter::setEnvironment("https://developer.zohoapis.eu", self::$EU->getIAMUrl(), self::$EU->getFileUploadUrl(), "eu_dev");
        }

        return self::$DEVELOPER;
    }

    public function getIAMUrl()
    {
        return "https://accounts.zoho.eu/oauth/v2/token";
    }

    public function getFileUploadUrl()
    {
        return "https://content.zohoapis.eu";
    }
}