<?php

namespace ASPTest\Models;

use PDO;
use Exception;
use ASPTest\Contracts\ConnectionTrait;


class UserPassword
{
    use ConnectionTrait;


    public static function save(array $data)
    {
        $sql = "UPDATE users SET pass = :pass WHERE id = :id";

        $connection = self::getConnection();
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try
        {
            $connection->beginTransaction();

            $statement = $connection->prepare($sql);
            $statement->bindParam(':pass', $data['password'], PDO::PARAM_STR);
            $statement->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $statement->execute();

            $connection->commit();
        }
        catch(Exception $e)
        {
            $connection->rollBack();

            throw $e;
        }

        return User::find($data['id']);
    }
}