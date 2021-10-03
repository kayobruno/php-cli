<?php

declare(strict_types=1);

namespace ASPTest\App\Commands;

use ASPTest\App\Services\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BaseUserCommand extends Command
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        parent::__construct();
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);
        /** @var InputArgument[] $inputArguments */
        foreach ($this->getDefinition()->getArguments() as $argument) {
            if (!$input->getArgument($argument->getName())) {
                $value = $io->ask($argument->getDescription());
                $input->setArgument($argument->getName(), $value);
            }
        }
    }
}