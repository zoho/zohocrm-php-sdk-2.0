<?php

namespace com\zoho\api\authenticator\store;

use com\zoho\api\authenticator\OAuthToken;

use com\zoho\api\authenticator\OAuthBuilder;

use com\zoho\crm\api\exception\SDKException;

use com\zoho\crm\api\util\Constants;

use Exception;

/**
 *
 * This class stores the user token details to the MySQL DataBase.
 *
 */
class DBStore implements TokenStore
{
    private $userName = null;

    private $portNumber = null;

    private $password = null;

    private $host = null;

    private $databaseName = null;

    private $tableName = null;

    /**
     * Create an DBStore class instance with the specified parameters.
     * @param string $host A string containing the DataBase host name.
     * @param string $databaseName A String containing the DataBase name.
     * @param string $tableName A String containing the DataBase table name.
     * @param string $userName A String containing the DataBase user name.
     * @param string $password A String containing the DataBase password.
     * @param string $portNumber A String containing the DataBase port number.
     */
    private function __construct($host, $databaseName, $tableName, $userName, $password, $portNumber)
    {
        $this->host = $host;

        $this->databaseName = $databaseName;

        $this->tableName = $tableName;

        $this->userName = $userName;

        $this->password = $password;

        $this->portNumber = $portNumber;
    }

    public function getToken($user, $token)
    {
        $connection = null;

        try
        {
            $connection = $this->getMysqlConnection();

            if($token instanceof OAuthToken)
            {
                $query = $this->constructDBQuery($user->getEmail(), $token, false);

                $result = mysqli_query($connection, $query);

                if ($result)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $token->setId($row[Constants::ID]);

                        $token->setAccessToken($row[Constants::ACCESS_TOKEN]);

                        $token->setExpiresIn($row[Constants::EXPIRY_TIME]);

                        $token->setRefreshToken($row[Constants::REFRESH_TOKEN]);

                        $token->setUserMail($row[Constants::USER_MAIL]);

                        return $token;
                    }
                }
            }
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::GET_TOKEN_DB_ERROR, null, $ex);
        }
        finally
        {
            if ($connection != null)
            {
                $connection->close();
            }
        }

        return null;
    }

    public function saveToken($user, $token)
    {
        $connection = null;

        try
        {
            if($token instanceof OAuthToken)
            {
                $token->setUserMail($user->getEmail());

                $this->deleteToken($token);

                $connection = $this->getMysqlConnection();

                $query = "INSERT INTO " . $this->tableName . " (id,user_mail,client_id,client_secret,refresh_token,access_token,grant_token,expiry_time,redirect_url) VALUES(?,?,?,?,?,?,?,?,?)";

                $stmt = mysqli_prepare($connection, $query);

                $id = $token->getId();

                $email = $user->getEmail();

                $clientId = $token->getClientId();

                $clientSecret = $token->getClientSecret();

                $refreshToken = $token->getRefreshToken();

                $accessToken = $token->getAccessToken();

                $grantToken = $token->getGrantToken();

                $expiresIn = $token->getExpiresIn();

                $redirectURL = $token->getRedirectURL();

                $stmt->bind_param('sssssssss', $id, $email, $clientId, $clientSecret, $refreshToken, $accessToken, $grantToken, $expiresIn, $redirectURL);
            }

            $result = $stmt->execute();

            if (!$result)
            {
                $message = $connection != null ? $connection->error : null;

                throw new \Exception(null, null, $message);
            }
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::SAVE_TOKEN_DB_ERROR, null, $ex);
        }
        finally
        {
            if ($connection != null)
            {
                $connection->close();
            }
        }
    }

    public function deleteToken($token)
    {
        $connection = null;

        try
        {
            $connection = $this->getMysqlConnection();

            if($token instanceof OAuthToken)
            {
                $query = $this->constructDBQuery($token->getUserMail(), $token, true);

                $result = mysqli_query($connection, $query);

                if (! $result)
                {
                    throw new \Exception($connection->error);
                }
            }
        }
        catch (SDKException $ex)
        {
            throw $ex;
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::DELETE_TOKEN_DB_ERROR, null, $ex);
        }
        finally
        {
            if ($connection != null)
            {
                $connection->close();
            }
        }
    }

    private function getMysqlConnection()
    {
        $mysqli_con = new \mysqli($this->host . ":" . $this->portNumber, $this->userName, $this->password, $this->databaseName);

        if ($mysqli_con->connect_errno)
        {
            throw new \Exception($mysqli_con->connect_error);
        }

        return $mysqli_con;
    }

    public function getTokens()
    {
        $connection = null;

        $tokens = array();

        try
        {
            $connection = $this->getMysqlConnection();

            $query = "select * from " . $this->tableName . ";";

            $result = mysqli_query($connection, $query);

            if ($result)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $grantToken = ($row[Constants::GRANT_TOKEN] !== null && $row[Constants::GRANT_TOKEN] !== Constants::NULL_VALUE && strlen($row[Constants::GRANT_TOKEN]) > 0) ? $row[Constants::GRANT_TOKEN] : null;

                    $token = (new OAuthBuilder())->clientId($row[Constants::CLIENT_ID])->clientSecret($row[Constants::CLIENT_SECRET])->refreshToken($row[Constants::REFRESH_TOKEN])->build();

                    $token->setId($row[Constants::ID]);

                    if($grantToken != null)
                    {
                        $token->setGrantToken($grantToken);
                    }

                    $token->setUserMail($row[Constants::USER_MAIL]);

                    $token->setAccessToken($row[Constants::ACCESS_TOKEN]);

                    $token->setExpiresIn($row[Constants::EXPIRY_TIME]);

                    $token->setRedirectURL($row[Constants::REDIRECT_URL]);

                    $tokens[] = $token;
                }
            }
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::GET_TOKENS_DB_ERROR, null, $ex);
        }
        finally
        {
            if ($connection != null)
            {
                $connection->close();
            }
        }

        return $tokens;
    }

    public function deleteTokens()
    {
        $connection = null;

        try
        {
            $connection = $this->getMysqlConnection();

            $query = "delete from " . $this->tableName . ";";

            mysqli_query($connection, $query);

        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::DELETE_TOKENS_DB_ERROR, null, $ex);
        }
        finally
        {
            if ($connection != null)
            {
                $connection->close();
            }
        }
    }

    private function constructDBQuery($email, $token, $is_delete=true)
    {
        if ($email === null)
        {
            throw new SDKException(Constants::USER_MAIL_NULL_ERROR, Constants::USER_MAIL_NULL_ERROR_MESSAGE);

        }
        $query = $is_delete ? "delete from " : "select * from ";

        $query .= $this->tableName . " where user_mail='" . $email . "' and client_id='" . $token->getClientId() . "' and ";

        if ($token->getGrantToken() != null)
        {
            $query .= "grant_token='" . $token->getGrantToken() . "'";
        }
        else
        {
            $query .= "refresh_token='" . $token->getRefreshToken() . "'";
        }

        return $query;
    }

    public function getTokenById($id, $token)
    {
        $connection = null;

        try
        {
            $connection = $this->getMysqlConnection();

            if($token instanceof OAuthToken)
            {
                $query = "select * from " . $this->tableName . " where id='" . $id . "'";

                $result = mysqli_query($connection, $query);

                if ($result)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $grantToken = ($row[Constants::GRANT_TOKEN] != null && $row[Constants::GRANT_TOKEN] !== Constants::NULL_VALUE && strlen($row[Constants::GRANT_TOKEN]) > 0)? $row[Constants::GRANT_TOKEN] : null;

                        $token->setClientId($row[Constants::CLIENT_ID]);

                        $token->setClientSecret($row[Constants::CLIENT_SECRET]);

                        $token->setRefreshToken($row[Constants::REFRESH_TOKEN]);

                        $token->setId($id);

                        if($grantToken != null)
                        {
                            $token->setGrantToken($grantToken);
                        }

                        $token->setUserMail($row[Constants::USER_MAIL]);

                        $token->setAccessToken($row[Constants::ACCESS_TOKEN]);

                        $token->setExpiresIn($row[Constants::EXPIRY_TIME]);

                        $token->setRedirectURL($row[Constants::REDIRECT_URL]);

                        return $token;
                    }
                }
                else
                {
                    throw new SDKException(Constants::TOKEN_STORE, Constants::GET_TOKEN_BY_ID_DB_ERROR);
                }
            }
        }
        catch (SDKException $ex)
        {
            throw $ex;
        }
        catch (\Exception $ex)
        {
            throw new SDKException(Constants::TOKEN_STORE, Constants::GET_TOKEN_DB_ERROR, null, $ex);
        }
        finally
        {
            if ($connection != null)
            {
                $connection->close();
            }
        }

        return null;
    }
}
?>