<?php

namespace ASPTest\Services;

use InvalidArgumentException;
use ASPTest\Models\User;

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

        if ( ! empty($age) && ($age < 1 || $age > 150)) {
            throw new InvalidArgumentException('Age argument is invalid.');
        }


        return User::save($data);
    }
}