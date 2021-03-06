<?php

namespace ASPTest\Commands;

use Throwable;
use ASPTest\Services\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\OutputInterface;

class UserCreateCommand extends Command
{
    protected
        static $defaultName = 'USER:CREATE';

    
    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to create a user.')
            ->setHelp('This command allows you to create a user with the information as follow: firstname (required), lastname (required), email (required) and age (optional).');

        $this
            ->addArgument('firstname', InputArgument::REQUIRED, 'The first name of the user (required).')
            ->addArgument('lastname', InputArgument::REQUIRED, 'The last name of the user (required).')
            ->addArgument('email', InputArgument::REQUIRED, 'The email contact of the user (required).')
            ->addArgument('age', InputArgument::OPTIONAL, 'The age of the user (optional).');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = [
            'firstname' => $input->getArgument('firstname'),
            'lastname' => $input->getArgument('lastname'),
            'email' => $input->getArgument('email'),
            'age' => $input->getArgument('age'),
        ];

        try
        {
            $user = UserService::create($data);

            $output->writeln('<info>User created: '. json_encode($user) .'</info>');

            return Command::SUCCESS;
        }
        catch (Throwable $e)
        {
            $output->writeln('<error>Error: '. $e->getMessage() .'</error>');
            
            return Command::FAILURE;
        }
    }  
}