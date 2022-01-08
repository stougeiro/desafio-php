<?php

namespace ASPTest\Services;

use ASPTest\Models\User;
use ASPTest\Models\UserPassword;
use ASPTest\Libraries\Password;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class UserPasswordService
{
    public static function create(array $data)
    {
        $id = (int) $data['id'];
        $password = $data['password'];
        $confirmation = $data['confirmation'];

        if (empty($id)) {
            throw new InvalidArgumentException('ID argument is required.');
        } else if ( ! is_int($id) || $id < 0) {
            throw new InvalidArgumentException('ID argument is invalid.');
        }

        if (empty($password)) {
            throw new InvalidArgumentException('Password argument is required.');
        }

        if (empty($confirmation)) {
            throw new InvalidArgumentException('Confirmation argument is required.');
        }

        if ( ! preg_match('/^(?=.*?[#?!@$%^&*-])(?=.*?[0-9])(?=.*?[A-Z]).{6,}$/', $password)) {
            throw new InvalidArgumentException('Password argument is invalid. Insert as least 6 characters, 1 special character, 1 number and 1 uppercase letter.');
        }

        if ($password !== $confirmation) {
            throw new InvalidArgumentException('Confirmation argument is invalid. Please, insert same password and password confirmation.');
        }

        $user = User::find($id);

        if ( ! $user) {
            throw new InvalidArgumentException('ID argument is invalid. User not found.');
        }

        $data['password'] = Password::encrypt($data['password']);

        return UserPassword::save($data);
    }
}