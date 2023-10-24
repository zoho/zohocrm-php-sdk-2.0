<?php

namespace com\zoho\api\authenticator\store;

use com\zoho\crm\api\util\Constants;

class DBBuilder
{
    private $userName = Constants::MYSQL_USER_NAME;

    private $portNumber = Constants::MYSQL_PORT_NUMBER;

    private $password = "";

    private $host = Constants::MYSQL_HOST;

    private $databaseName = Constants::MYSQL_DATABASE_NAME;

    private $tableName = Constants::MYSQL_TABLE_NAME;

    private $sslKey = null;

    private $sslCertificate = null;

    private $sslCaCertificate = null;

    private $sslCaPath = null;

    private $sslCipherAlgos = null;

    public function userName(string $userName)
    {
        if($userName != null)
        {
            $this->userName = $userName;
        }

        return $this;
    }

    public function portNumber(string $portNumber)
    {
        if($portNumber != null)
        {
            $this->portNumber = $portNumber;
        }

        return $this;
    }

    public function password(string $password)
    {
        if($password != null)
        {
            $this->password = $password;
        }

        return $this;
    }

    public function host(string $host)
    {
        if($host != null)
        {
            $this->host = $host;
        }

        return $this;
    }

    public function databaseName(string $databaseName)
    {
        if($databaseName != null)
        {
            $this->databaseName = $databaseName;
        }

        return $this;
    }

    public function tableName(string $tableName)
    {
        if($tableName != null)
        {
            $this->tableName = $tableName;
        }

        return $this;
    }

    /**
     * Sets up SSL options/parameters (to be passed into mysqli::ssl_set())
     * @param string|null $key           location of ssl keyfile
     * @param string|null $certificate   location of SSL certificate
     * @param string|null $caCertificate location of SSL CA Certificate
     * @param string|null $caPath
     * @param string|null $cipherAlgos
     *
     * @returns DBBuilder
     */
    public function ssl(
        string $key = null,
        string $certificate = null,
        string $caCertificate = null,
        string $caPath = null,
        string $cipherAlgos = null
    ): DBBuilder {
        $this->sslKey = $key;
        $this->sslCertificate = $certificate;
        $this->sslCaCertificate = $caCertificate;
        $this->sslCaPath = $caPath;
        $this->sslCipherAlgos = $cipherAlgos;

        return $this;
    }

    public function build()
    {
        $class = new \ReflectionClass(DBStore::class);

        $constructor = $class->getConstructor();

        $constructor->setAccessible(true);

        $object = $class->newInstanceWithoutConstructor();

        $constructor->invoke($object, $this->host, $this->databaseName, $this->tableName, $this->userName, $this->password, $this->portNumber);

        return $object;
    }
}
?>