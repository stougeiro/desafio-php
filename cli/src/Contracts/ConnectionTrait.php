<?php

namespace ASPTest\Contracts;

use PDO;
use Exception;


trait ConnectionTrait
{
    protected
        static $connection;


    protected static function getConnection()
    {
        if ( ! file_exists(DATABASE_FILE)) {
            try
            {
                $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INTEGER NOT NULL PRIMARY KEY, 
                    firstname VARCHAR (35) NOT NULL, 
                    lastname VARCHAR(35) NOT NULL, 
                    email VARCHAR(255) NOT NULL, 
                    age INTEGER DEFAULT NULL, 
                    pass TEXT DEFAULT NULL
                );";

                $connection = new PDO("sqlite:".DATABASE_FILE);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->exec($sql);
            }
            catch (Exception $e)
            {
                throw $e;
            }

            self::$connection = $connection;
        }

        if (self::$connection === null) {
            self::$connection = new PDO("sqlite:".DATABASE_FILE);
        }

        return self::$connection;
    }
}