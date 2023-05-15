<?php
namespace Zoho\Api\Authenticator\Store;

use Zoho\Api\Authenticator\OAuthBuilder;
use Zoho\Api\Authenticator\OAuthToken;
use Zoho\Crm\Exception\SDKException;
use Zoho\Crm\Util\Constants;

/**
 * This class stores the user token details to the file.
 */
class FileStore implements TokenStore
{
    private $filePath = null;

    private $headers = array(Constants::ID, Constants::USER_MAIL, Constants::CLIENT_ID, Constants::CLIENT_SECRET, Constants::REFRESH_TOKEN, Constants::ACCESS_TOKEN, Constants::GRANT_TOKEN, Constants::EXPIRY_TIME, Constants::REDIRECT_URL);

    /**
     * Creates an FileStore class instance with the specified parameters.
     * @param string $filePath A string containing the absolute file path to store tokens.
     */
    public function __construct($filePath)
    {
        $this->filePath = trim($filePath);

        $csvWriter = fopen($this->filePath, 'a');//opens file in append mode

        if (trim(file_get_contents($this->filePath)) == false)
        {
            fwrite($csvWriter, implode(",", $this->headers));
        }

        fclose($csvWriter);
    }

    public function getToken($user, $token)
    {
        $csvReader = null;

        try
        {
            $csvReader = file($this->filePath, FILE_IGNORE_NEW_LINES);

            if($token instanceof OAuthToken)
            {
                for($index = 1; $index < sizeof($csvReader); $index++)
                {
                    $allContents = $csvReader[$index];

                    $nextRecord = str_getcsv($allContents);

                    if($this->checkTokenExists($user->getEmail(), $token, $nextRecord))
                    {
                        $token->setAccessToken($nextRecord[5]);

                        $token->setExpiresIn($nextRecord[7]);

                        $token->setRefreshToken($nextRecord[4]);

                        $token->setId($nextRecord[0]);

                        $token->setUserMail($nextRecord[1]);

                        return $token;
                    }
                }
            }
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::GET_TOKEN_FILE_ERROR, null, $ex);
        }

        return null;
    }

    public function saveToken($user, $token)
    {
        $csvWriter = null;

        try
        {
            if($token instanceof OAuthToken)
            {
                $token->setUserMail($user->getEmail());

                $this->deleteToken($token);

                $data = array(
                    $token->getId(),
                    $user->getEmail(),
                    $token->getClientId(),
                    $token->getClientSecret(),
                    $token->getRefreshToken(),
                    $token->getAccessToken(),
                    $token->getGrantToken(),
                    $token->getExpiresIn(),
                    $token->getRedirectURL()
                );
            }

            $csvWriter = file($this->filePath);

            array_push($csvWriter, "\n");

            array_push($csvWriter, implode(",", $data));

            file_put_contents($this->filePath, $csvWriter);
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::SAVE_TOKEN_FILE_ERROR, null, $ex);
        }
    }

    public function deleteToken($token)
    {
        $csvReader = null;

        try
        {
            $csvReader = file($this->filePath, FILE_IGNORE_NEW_LINES);

            $deleted = false;

            if( $token instanceof OAuthToken)
            {
                for ($index = 1; $index < sizeof($csvReader); $index++)
                {
                    $allContents = $csvReader[$index];

                    $nextRecord = str_getcsv($allContents);

                    if ($this->checkTokenExists($token->getUserMail(), $token, $nextRecord))
                    {
                        unset($csvReader[$index]);

                        $deleted = true;

                        break; // Stop searching after we found the email
                    }
                }

                // Rewrite the file if we deleted the user account details.
                if ($deleted)
                {
                    file_put_contents($this->filePath, implode("\n", $csvReader));
                }
            }
        }
        catch(SDKException $ex)
        {
            throw $ex;
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::DELETE_TOKEN_FILE_ERROR, null, $ex);
        }
    }

    public function getTokens()
    {
        $csvReader = null;

        $tokens = array();

        try
        {
            $csvReader = file($this->filePath, FILE_IGNORE_NEW_LINES);

            for ($index = 1; $index < sizeof($csvReader); $index++)
            {
                $allContents = $csvReader[$index];

                $nextRecord = str_getcsv($allContents);

                $grantToken = ($nextRecord[6] != null && strlen($nextRecord[6]) > 0) ? $nextRecord[6] : null;

                $token = (new OAuthBuilder())->clientId($nextRecord[2])->clientSecret($nextRecord[3])->refreshToken($nextRecord[4])->build();

                $token->setId($nextRecord[0]);

                if($grantToken != null)
                {
                    $token->setGrantToken($grantToken);
                }

                $token->setUserMail(strval($nextRecord[1]));

                $token->setAccessToken($nextRecord[5]);

                $token->setExpiresIn($nextRecord[7]);

                $token->setRedirectURL($nextRecord[8]);

                $tokens[] = $token;
            }
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::GET_TOKENS_FILE_ERROR, null, $ex);
        }

        return $tokens;
    }

    public function deleteTokens()
    {
        try
        {
            file_put_contents($this->filePath, implode(",", $this->headers));
        }
        catch(\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::DELETE_TOKENS_FILE_ERROR, null, $ex);
        }
    }

    private function checkTokenExists($email, $oauthToken, $row)
    {
        if ($email === null)
        {
            throw new SDKException(Constants::USER_MAIL_NULL_ERROR, Constants::USER_MAIL_NULL_ERROR_MESSAGE);
        }

        $clientId = (string)$oauthToken->getClientId();

        $grantToken = (string)$oauthToken->getGrantToken();

        $refreshToken = (string)$oauthToken->getRefreshToken();

        $tokenCheck = $grantToken != null ? $grantToken === (string)$row[6] : $refreshToken === (string)$row[4];

        if($email === $row[1] && $clientId === $row[2] && $tokenCheck )
        {
            return true;
        }

        return false;
    }

    public function getTokenById($id, $token)
    {
        $csvReader = null;

        try
        {
            $csvReader = file($this->filePath, FILE_IGNORE_NEW_LINES);

            if ($token instanceof OAuthToken)
            {
                $isRowPresent = false;

                for ($index = 1; $index < sizeof($csvReader); $index++)
                {
                    $allContents = $csvReader[$index];

                    $nextRecord = str_getcsv($allContents);

                    if ($nextRecord[0] == $id)
					{
                        $isRowPresent = true;

                        $grantToken = ($nextRecord[6] != null && strlen($nextRecord[6]) > 0)? $nextRecord[6] : null;

						$redirectURL = ($nextRecord[8] != null && strlen($nextRecord[8]) > 0)? $nextRecord[8] : null;

                        $token->setClientId($nextRecord[2]);

                        $token->setClientSecret($nextRecord[3]);

						$token->setRefreshToken($nextRecord[4]);

                        $token->setId($id);

                        if($grantToken != null)
                        {
                            $token->setGrantToken($grantToken);
                        }

                        $token->setUserMail($nextRecord[1]);

                        $token->setAccessToken($nextRecord[5]);

                        $token->setExpiresIn($nextRecord[7]);

                        $token->setRedirectURL($redirectURL);

                        return $token;
                    }
                }

                if(!$isRowPresent)
				{
					throw new SDKException(Constants::TOKEN_STORE, Constants::GET_TOKEN_BY_ID_FILE_ERROR);
				}
            }
        }
        catch (SDKException $ex)
        {
            throw $ex;
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::GET_TOKEN_FILE_ERROR, null, $ex);
        }

        return null;
    }
}
