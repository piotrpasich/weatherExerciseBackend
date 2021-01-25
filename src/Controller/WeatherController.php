<?php

namespace App\Controller;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Contracts\HttpClient\WeatherClient;
use App\Repository\CityRepository;
use App\Repository\WeatherLogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;


class WeatherController extends AbstractController
{
    private $weatherLogRepository;
    private $cityRepository;
    private $serializer;

    public function __construct(
        WeatherLogRepository $weatherLogRepository,
        CityRepository $cityRepository,
        SerializerInterface $serializer
    ) {
        $this->weatherLogRepository = $weatherLogRepository;
        $this->cityRepository = $cityRepository;
        $this->serializer = $serializer;
    }
    /**
     * @Route("/weather", name="weather")
     */
    public function index(): Response
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);

        $logs = $this->weatherLogRepository->findAll();
        $data = $serializer->normalize($logs, null, [ 'groups' => 'weather' ]);

        return $this->json($data);
    }
}
