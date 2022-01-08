<?php

namespace ASPTest\Services;

use ASPTest\Models\User;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class UserService
{
    public static function create(array $data)
    {
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $age = $data['age'];

        if (empty($firstname)) {
            throw new InvalidArgumentException('Firstname argument is required.');
        } else if (strlen($firstname) < 2 || strlen($firstname) > 35) {
            throw new InvalidArgumentException('Firstname argument must be between 2 and 35 characters.');
        }

        if (empty($lastname)) {
            throw new InvalidArgumentException('Lastname argument is required.');
        } else if (strlen($lastname) < 2 || strlen($lastname) > 35) {
            throw new InvalidArgumentException('Lastname argument must be between 2 and 35 characters.');
        }

        if (empty($email)) {
            throw new InvalidArgumentException('Email argument is required.');
        } else if (strlen($email) > 255) {
            throw new InvalidArgumentException('Email argument must be at most 255 characters.');
        } else if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email argument is invalid.');
        }

        if (null === $age) {
            goto save;
        } else if ( ! preg_match("/^[0-9]{1,3}$/", $age)) {
            throw new InvalidArgumentException('Age argument is invalid.');
        }

        $age = (int) $age;

        if ($age < 1 || $age > 150) {
            throw new InvalidArgumentException('Age argument must be between 1 and 150.');
        }


        save:

        return User::save($data);
    }
}