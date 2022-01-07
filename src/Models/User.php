<?php

namespace ASPTest\Models;

use PDO;
use Exception;
use ASPTest\Contracts\ConnectionTrait;


class User
{
    use ConnectionTrait;


    public static function find(int $id)
    {
        $sql = "SELECT id, firstname, lastname, email, age, pass FROM users WHERE id=:id";

        $connection = self::getConnection();

        $statement = $connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);


        return $user;
    }

    public static function save(array $data)
    {
        $sql = "INSERT INTO users (firstname, lastname, email, age) VALUES (:firstname, :lastname, :email, :age)";
        
        $connection = self::getConnection();
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try
        {
            $connection->beginTransaction();

            $statement = $connection->prepare($sql);
            $statement->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
            $statement->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
            $statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $statement->bindParam(':age', $data['age'], PDO::PARAM_NULL | PDO::PARAM_INT);
            $statement->execute();

            $id = $connection->lastInsertId();

            $connection->commit();
        }
        catch(Exception $e)
        {
            $connection->rollBack();

            throw $e;
        }

        return self::find($id);
    }
}