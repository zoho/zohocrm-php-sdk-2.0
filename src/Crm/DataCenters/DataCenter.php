<?php
namespace Zoho\Crm\DataCenters;

/**
 * The abstract class represents the properties of Zoho CRM DataCenter.
 */
abstract class DataCenter
{
    /**
     *  This method to get accounts URL. URL to be used when calling an OAuth accounts.
     * @return string A string representing the accounts URL.
     */
    public abstract function getIAMUrl();

    /**
     * This method to get File Upload URL.
     * @return string A string representing the File Upload URL.
     */
    public abstract function getFileUploadUrl();

    public static function setEnvironment($url, $accountUrl, $fileUploadUrl, $name)
    {
        return new Environment($url, $accountUrl, $fileUploadUrl, $name);
    }
}
