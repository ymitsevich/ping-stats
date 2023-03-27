<?php

namespace App\Command;

use App\Service\NetworkMonitorAgent;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'run:monitor',
    description: 'Start monitoring network connection',
)]
class RunMonitorCommand extends Command
{
    public function __construct(private readonly NetworkMonitorAgent $networkMonitorAgent)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->comment('Press ctrl-c to break the monitor.');
        $this->networkMonitorAgent->run();

        $io->success('Completed.');

        return Command::SUCCESS;
    }
}
