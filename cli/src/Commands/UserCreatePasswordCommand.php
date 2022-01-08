<?php

namespace ASPTest\Commands;

use Throwable;
use ASPTest\Services\UserPasswordService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\OutputInterface;

class UserCreatePasswordCommand extends Command
{
    protected
        static $defaultName = 'USER:CREATE-PWD';

    
        protected function configure(): void
        {
            $this
                ->setDescription('This command allows you to create a password for a user.')
                ->setHelp('This command allows you to create a password for a user with the information as follow: id (required), password (required) and confirmation (required).');
    
            $this
                ->addArgument('id', InputArgument::REQUIRED, 'The ID of the user (required).')
                ->addArgument('password', InputArgument::REQUIRED, 'The password for the user (required).')
                ->addArgument('confirmation', InputArgument::REQUIRED, 'The password confirmation for the user (required).');
        }
    
        protected function execute(InputInterface $input, OutputInterface $output): int
        {
            $data = [
                'id' => $input->getArgument('id'),
                'password' => $input->getArgument('password'),
                'confirmation' => $input->getArgument('confirmation'),
            ];
    
            try
            {
                $user = UserPasswordService::create($data);

                $output->writeln('<info>Password created: '. json_encode($user) .'</info>');

                return Command::SUCCESS;
            }
            catch (Throwable $e)
            {
                $output->writeln('<error>Error: '. $e->getMessage() .'</error>');
                
                return Command::FAILURE;
            }

        } 
}