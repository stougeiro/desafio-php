<?php

namespace Tests\Services;

use ASPTest\Services\UserService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class UserServiceTest extends TestCase
{
    public function nameDataProvider()
    {
        return [
            [''],                                               // empty
            ['f'],                                              // < 2
            ['a simple phrase with more than 35 characters'],   // > 35
        ];
    }

    /**
     * @dataProvider nameDataProvider
     */
    public function testUserServiceWithWrongFirstnameArgument($name)
    {
        $data = [
            'firstname' => $name,
            'lastname' => 'Lastname',
            'email' => 'email@test.com',
            'age' => null,
        ];

        $this->expectException(InvalidArgumentException::class);

        UserService::create($data);
    }

    /**
     * @dataProvider nameDataProvider
     */
    public function testUserServiceWithWrongLastnameArgument($name)
    {
        $data = [
            'firstname' => 'Firstname',
            'lastname' => $name,
            'email' => 'email@test.com',
            'age' => null,
        ];

        $this->expectException(InvalidArgumentException::class);

        UserService::create($data);
    }


    public function emailDataProvider()
    {
        return [
            ['email'],
            ['email.'],
            ['email@test'],
            ['email@test.'],
            ['email@test..s'],
            ['email@@test.com'],
        ];
    }

    /**
     * @dataProvider emailDataProvider
     */
    public function testUserServiceWithWrongEmailArgument($email)
    {
        $data = [
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => $email,
            'age' => null,
        ];

        $this->expectException(InvalidArgumentException::class);

        UserService::create($data);
    }


    public function ageDataProvider()
    {
        return [
            [''],   // empty
            ['a'],  // ![0-9] && string
            [151],  // > 150
            [1568], // !{1,3} && > 150
        ];

    }

    /**
     * @dataProvider ageDataProvider
     */
    public function testUserServiceWithWrongAgeArgument($age)
    {
        $data = [
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'email@teste.com',
            'age' => $age,
        ];

        $this->expectException(InvalidArgumentException::class);

        UserService::create($data);
    }
}