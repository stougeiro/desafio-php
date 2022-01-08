<?php

namespace Tests\Commands;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use ASPTest\Commands\UserCreatePasswordCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class UserCreatePasswordCommandTest extends TestCase
{
    public function testIfCommandExists()
    {
        $application = new Application();
        $application->add(new UserCreatePasswordCommand());

        $command = $application->get('USER:CREATE-PWD');

        $this->assertTrue($command ? true : false);
    }


    public function testCommandWithNoArguments()
    {
        $application = new Application();
        $application->add(new UserCreatePasswordCommand());
        
        $command = $application->find('USER:CREATE-PWD');

        $this->expectException(RuntimeException::class);

        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
    }


    public function argumentsDataProvider()
    {
        return [
            [ ['id' => '', 'pass' => 'bb'] ],
            [ ['bcdfg' => 15, 'aeiou' => 'test'] ],
            [ ['id' => 2, 'password' => 'ss', 'xonfi' => 'emailtest', ] ],
        ];
    }

    /**
     * @dataProvider argumentsDataProvider
     */
    public function testCommandWithWrongArgumentsNamesOrFewArguments($arguments)
    {
        $application = new Application();
        $application->add(new UserCreatePasswordCommand());
        
        $command = $application->find('USER:CREATE-PWD');

        $this->expectException(InvalidArgumentException::class);

        $commandTester = new CommandTester($command);
        $commandTester->execute($arguments);
    }
}