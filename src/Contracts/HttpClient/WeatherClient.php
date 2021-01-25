<?php
namespace App\Contracts\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherClient
{
    private $client;

    private $apiKey = 'a74289eb1383fa0e57264af1b7f50051';
    private $city = 'Gliwice';
    private $urlBase = 'http://api.openweathermap.org/data/2.5/';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchForecast (): array
    {
        $response = $this->client->request(
            'GET',
            "{$this->urlBase}weather?q={$this->city}&appid={$this->apiKey}&units=metric"
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        return $content;
    }
    public function getWeather (): array
    {
        $response = $this->client->request(
            'GET',
            "{$this->urlBase}weather?q={$this->city}&appid={$this->apiKey}&units=metric"
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();
        var_dump($content);

        return $content;
    }
}
