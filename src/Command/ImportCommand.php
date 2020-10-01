<?php

namespace App\Command;

use App\Entity\RatesEntity;
use App\ExchangeRate\ApiData;
use App\ExchangeRate\ExchangeRateMonobank;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ImportCommand extends Command
{
    protected static $defaultName = 'import';

    private ContainerInterface $container;

    public function __construct(string $name = null, ContainerInterface $container)
    {
        parent::__construct($name);
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $apiData = new ApiData(new ExchangeRateMonobank(new RatesEntity(), $this->container->get('doctrine')->getManager()));
        } catch (\Exception $e) {
            $io->error('Произошла ошибка');
            return Command::SUCCESS;
        }

        if ($apiData->run()) {
            $io->success('Данные добавлены');
        } else {
            $io->error('Произошла ошибка');
        }

        return Command::SUCCESS;
    }
}
