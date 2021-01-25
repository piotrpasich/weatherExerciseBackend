<?php

namespace App\Command;

use App\Repository\CityRepository;
use App\Repository\WeatherLogRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Contracts\HttpClient\WeatherClient;

class WeatherUpdateCommand extends Command
{
    protected static $defaultName = 'weather:update';

    private $weatherClient;
    private $cityRepository;
    private $weatherLogRepository;

    public function __construct(
        WeatherClient $weatherClient,
        CityRepository $cityRepository,
        WeatherLogRepository $weatherLogRepository
    )
    {
        $this->weatherClient = $weatherClient;
        $this->cityRepository = $cityRepository;
        $this->weatherLogRepository = $weatherLogRepository;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Update weather')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $weather = $this->weatherClient->getWeather();
        $forecast = $this->weatherClient->fetchForecast();
        $city = $this->cityRepository->upsertCityFromForecast($forecast);
        $this->weatherLogRepository->insert($weather, $city);

        $io = new SymfonyStyle($input, $output);
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
