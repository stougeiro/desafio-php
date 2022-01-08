<?php

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use ASPTest\Services\UserPasswordService;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class UserPasswordServiceTest extends TestCase
{
    public function idDataProvider()
    {
        return [
            [''],   // empty
            ['f'],  // string
            [-5],   // negative
        ];
    }

    /**
     * @dataProvider idDataProvider
     */
    public function testUserPasswordServiceWithWrongIdArgument($id)
    {
        $data = [
            'id' => $id,
            'password' => 'P@ssw0rd',
            'confirmation' => 'P@ssw0rd',
        ];

        $this->expectException(InvalidArgumentException::class);

        UserPasswordService::create($data);
    }


    public function passwordDataProvider()
    {
        return [
            ['a'],          // < 6
            ['password'],   // no uppercase, no special char, no number
            ['Password'],   // no special char, no number
            ['P@ssword'],   // no number
        ];
    }

    /**
     * @dataProvider passwordDataProvider
     */
    public function testUserPasswordServiceWithWrongPasswordArgument($password)
    {
        $data = [
            'id' => 1,
            'password' => $password,
            'confirmation' => $password,
        ];

        $this->expectException(InvalidArgumentException::class);

        UserPasswordService::create($data);
    }
}