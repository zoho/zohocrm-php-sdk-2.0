<?php
namespace Zoho\Crm\DataCenters;

/**
 * This class represents the properties of Zoho CRM in IN Domain.
 */
class India extends DataCenter
{
    private static $PRODUCTION = null;

    private static $SANDBOX = null;

    private static $DEVELOPER = null;

    private static $IN = null;

    /**
     * This Environment class instance represents the Zoho CRM Production Environment in IN Domain.
     * @return Environment A Environment class instance.
     */
    public static function PRODUCTION()
    {
        self::$IN = new India();

        if (self::$PRODUCTION == null)
        {
            self::$PRODUCTION = DataCenter::setEnvironment("https://www.zohoapis.in", self::$IN ->getIAMUrl(), self::$IN->getFileUploadUrl(), "in_prd");
        }

        return self::$PRODUCTION;
    }

    /**
     * This Environment class instance represents the Zoho CRM Sandbox Environment in IN Domain.
     * @return Environment A Environment class instance.
     */
    public static function SANDBOX()
    {
        self::$IN = new India();

        if (self::$SANDBOX == null)
        {
            self::$SANDBOX = DataCenter::setEnvironment("https://sandbox.zohoapis.in", self::$IN ->getIAMUrl(), self::$IN->getFileUploadUrl(), "in_sdb");
        }

        return self::$SANDBOX;
    }

    /**
     * This Environment class instance represents the Zoho CRM Developer Environment in IN Domain.
     * @return Environment A Environment class instance.
     */
    public static function DEVELOPER()
    {
        self::$IN = new India();

        if (self::$DEVELOPER == null)
        {
            self::$DEVELOPER = DataCenter::setEnvironment("https://developer.zohoapis.in", self::$IN ->getIAMUrl(), self::$IN->getFileUploadUrl(), "in_dev");
        }

        return self::$DEVELOPER;
    }

    public function getIAMUrl()
    {
        return "https://accounts.zoho.in/oauth/v2/token";
    }

    public function getFileUploadUrl()
    {
        return "https://content.zohoapis.in";
    }
}
