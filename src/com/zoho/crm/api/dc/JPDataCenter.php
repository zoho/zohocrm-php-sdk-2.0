<?php
namespace com\zoho\crm\api\dc;

use com\zoho\crm\api\dc\DataCenter;

/**
 * This class represents the properties of Zoho CRM in Japan Domain.
 */
class JPDataCenter extends DataCenter
{
    private static $PRODUCTION = null;

    private static $SANDBOX = null;

    private static $DEVELOPER = null;

    private static $JP = null;

    /**
     * This Environment class instance represents the Zoho CRM Production Environment in Japan Domain.
     * @return Environment A Environment class instance.
     */
    public static function PRODUCTION()
    {
        self::$JP = new JPDataCenter();

        if (self::$PRODUCTION == null)
        {
            self::$PRODUCTION = DataCenter::setEnvironment("https://www.zohoapis.jp", self::$JP->getIAMUrl(), self::$JP->getFileUploadUrl(), "jp_prd");
        }

        return self::$PRODUCTION;
    }

    /**
     * This Environment class instance represents the Zoho CRM Sandbox Environment in Japan Domain.
     * @return Environment A Environment class instance.
     */
    public static function SANDBOX()
    {
        self::$JP = new JPDataCenter();

        if (self::$SANDBOX == null)
        {
            self::$SANDBOX = DataCenter::setEnvironment("https://sandbox.zohoapis.jp", self::$JP->getIAMUrl(), self::$JP->getFileUploadUrl(), "jp_sdb");
        }

        return self::$SANDBOX;
    }

    /**
     * This Environment class instance represents the Zoho CRM Developer Environment in Japan Domain.
     * @return Environment A Environment class instance.
     */
    public static function DEVELOPER()
    {
        self::$JP = new JPDataCenter();

        if (self::$DEVELOPER == null)
        {
            self::$DEVELOPER = DataCenter::setEnvironment("https://developer.zohoapis.jp", self::$JP->getIAMUrl(), self::$JP->getFileUploadUrl(), "jp_dev");
        }

        return self::$DEVELOPER;
    }

    public function getIAMUrl()
    {
        return "https://accounts.zoho.jp/oauth/v2/token";
    }

    public function getFileUploadUrl()
    {
        return "https://content.zohoapis.jp";
    }
}