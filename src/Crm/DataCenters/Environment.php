<?php

namespace Zoho\Crm\DataCenters;

class Environment
{
    public $url = null;

    public $accountUrl = null;

    public $fileUploadUrl = null;

    public $name = null;

    public function __construct($url, $accountUrl, $fileUploadUrl, $name)
    {
        $this->url = $url;

        $this->accountUrl = $accountUrl;

        $this->fileUploadUrl = $fileUploadUrl;

        $this->name = $name;
    }

    /**
     * This method to get Zoho CRM API URL.
     * @return string A string representing the Zoho CRM API URL.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * This method to get Zoho CRM Accounts URL.
     * @return string A string representing the accounts URL.
     */
    public function getAccountsUrl()
    {
        return $this->accountUrl;
    }

    /**
     * This method to get File Upload URL.
     * @return string A string representing the File Upload URL.
     */
    public function getFileUploadUrl()
    {
        return $this->fileUploadUrl;
    }

    /**
     * This method to get name.
     * @return string A string representing the name.
     */
    public function getName()
    {
        return $this->name;
    }
}
