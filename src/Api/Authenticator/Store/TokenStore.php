<?php

namespace Zoho\Api\Authenticator\Store;

use com\zoho\api\authenticator\store\A;
use com\zoho\api\authenticator\store\id;
use com\zoho\api\authenticator\store\SDKException;
use Zoho\Api\Authenticator\Token;
use Zoho\Crm\UserSignature;

/**
 * This interface stores the user token details.
 */
interface TokenStore
{
    /**
     * This method is used to get user token details.
     * @param UserSignature $user A UserSignature class instance.
     * @param Token $token A Token class instance.
     * @return Token A Token class instance representing the user token details.
     */
    public function getToken($user, $token);

    /**
     * This method is used to retrieve the user token details based on unique ID
     * @param id A String representing the unique ID
     * @param token A Token class instance.
     * @return A Token class instance representing the user token details.
     * @throws SDKException
     */
    public function getTokenById($id, $token);

    /**
     * This method is used to store user token details.
     * @param UserSignature $user A UserSignature class instance.
     * @param Token $token A Token class instance.
     */
    public function saveToken($user, $token);

    /**
     * This method is used to delete user token details.
     * @param Token $token A Token class instance.
     */
    public function deleteToken($token);

    /**
     * The method to retrieve all the stored tokens.
     */
    public function getTokens();

    /**
     * The method to delete all the stored tokens.
     */
    public function deleteTokens();
}
