<?php

namespace App\Cards\Infrastructure\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use App\Cards\Application\Service\CardImportService;

class SyncCardsCommand extends Command
{
    public function __construct(
        private readonly CardImportService $cardImportService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:sync-cards')
            ->setDescription('Sincroniza las tarjetas desde el proveedor externo')
            ->addOption('provider', 'p', InputOption::VALUE_REQUIRED, '¿Qué proveedor usar?', 'finance_ads');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $provider = $input->getOption('provider');
            
            $result = $this->cardImportService->importCards($provider);

            $output->writeln(sprintf(
                'Sincronización completada: %d creadas, %d actualizadas, %d existentes',
                $result['created'],
                $result['updated'],
                $result['existing']
            ));

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>Error: %s</error>', $e->getMessage()));
            return Command::FAILURE;
        }
    }
} 