<?php 

namespace App\Cards\Command;

use App\Cards\Message\SyncMessage;
use App\Cards\Service\financeAdsService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Sync Cards Command
 */
#[AsCommand(name: 'app:sync-cards')]
class SyncCards extends Command
{

    public function __construct(private financeAdsService $financeAdsService, private MessageBusInterface $bus  )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addOption('async', 'a', InputOption::VALUE_NONE, 'Run the command asynchronously');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        if ($input->getOption('async')) {
            $this->bus->dispatch(new SyncMessage());
        } else {
            $count = $this->financeAdsService->syncCards();
            $output->writeln(sprintf('Updated: %d, Created: %d, Existing: %d', $count['updated'], $count['created'], $count['existing']));
        }

        return Command::SUCCESS;
    }
}