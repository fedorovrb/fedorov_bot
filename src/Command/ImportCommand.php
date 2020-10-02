<?php

namespace App\Command;

use App\Entity\RatesEntity;
use App\ExchangeRate\ApiData;
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

    const PRIVATBANK = 'Privatbank';
    const MONOBANK = 'Monobank';
    const NBU = 'Nbu';

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

        foreach (array(self::MONOBANK, self::PRIVATBANK, self::NBU) as $value) {
            try {
                $className = 'App\ExchangeRate\ExchangeRate' . $value;
                $apiData = new ApiData(new $className(new RatesEntity(), $this->container->get('doctrine')->getManager()));
            } catch (\Exception $e) {
                $io->error($value . ': Произошла ошибка при синхронизации');
                return Command::SUCCESS;
            }

            if ($apiData->run()) {
                $io->success($value . ': Данные добавлены');
            } else {
                $io->error($value . ': Произошла ошибка');
            }
        }

        return Command::SUCCESS;
    }
}
