<?php
namespace Zoho\Crm;

use Zoho\Crm\Exception\SDKException;
use Zoho\Crm\Util\Constants;

/**
 * This class represents the CRM user email.
 */
class UserSignature
{
    private $email = null;

    /**
     * Creates an UserSignature class instance with the specified user email.
     * @param string $email A string containing the CRM user email.
     */
    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error = array();

            $error[Constants::FIELD] =  Constants::EMAIL;

            $error[Constants::EXPECTED_TYPE] = Constants::EMAIL;

            throw new SDKException(Constants::USER_SIGNATURE_ERROR, null, $error, null);
        }

        $this->email = $email;
    }

    /**
     * This is a getter method to get user email.
     * @return string A string representing the CRM user email.
     */
    public function getEmail()
    {
        return $this->email;
    }
}
