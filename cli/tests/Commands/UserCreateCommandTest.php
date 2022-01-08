<?php

namespace Tests\Commands;

use PHPUnit\Framework\TestCase;
use ASPTest\Commands\UserCreateCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class UserCreateCommandTest extends TestCase
{
    public function testIfCommandExists()
    {
        $application = new Application();
        $application->add(new UserCreateCommand());

        $command = $application->get('USER:CREATE');

        $this->assertTrue($command ? true : false);
    }


    public function testCommandWithNoArguments()
    {
        $application = new Application();
        $application->add(new UserCreateCommand());
        
        $command = $application->find('USER:CREATE');

        $this->expectException(RuntimeException::class);

        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
    }


    public function argumentsDataProvider()
    {
        return [
            [ ['a' => '', 'b' => 'bb'] ],
            [ ['bcdfg' => 15, 'aeiou' => 'test'] ],
            [ ['firstname' => 'First', 'lastname' => 'Last', 'abc' => 'email@test', ] ],
        ];
    }

    /**
     * @dataProvider argumentsDataProvider
     */
    public function testCommandWithWrongArgumentsNamesOrFewArguments($arguments)
    {
        $application = new Application();
        $application->add(new UserCreateCommand());
        
        $command = $application->find('USER:CREATE');

        $this->expectException(InvalidArgumentException::class);

        $commandTester = new CommandTester($command);
        $commandTester->execute($arguments);
    }
}