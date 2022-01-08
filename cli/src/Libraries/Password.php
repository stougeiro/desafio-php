<?php

namespace ASPTest\Libraries;


class Password
{
    public static function encrypt($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}