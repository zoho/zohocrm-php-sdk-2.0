<?php
namespace com\zoho\crm\api\util;

/**
 * This class processes the API response object to the POJO object and POJO object to an XML object.
 */
class XMLConverter extends Converter
{
    public function __construct($commonAPIHandler)
    {
        parent::__construct($commonAPIHandler);
    }

    public function formRequest($requestObject, $pack, $instanceNumber, $memberDetail=null)
    {
        return null;
    }

    public function appendToRequest(&$requestBase, $requestObject)
    {
        return null;
    }

    public function getWrappedResponse($responseObject, $pack)
    {
        return $this->getResponse($responseObject, $pack);
    }

    public function getResponse($response, $pack)
    {
        return null;
    }
}