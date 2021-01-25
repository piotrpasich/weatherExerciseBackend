<?php

namespace App\Entity;

use App\Repository\WeatherLogRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=WeatherLogRepository::class)
 */
class WeatherLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"weather"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"weather"})
     */
    private $dt;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"weather"})
     */
    private $sunrise;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"weather"})
     */
    private $sunset;

    /**
     * @ORM\Column(type="float")
     * @Groups({"weather"})
     */
    private $temp_min;

    /**
     * @ORM\Column(type="float")
     * @Groups({"weather"})
     */
    private $temp;

    /**
     * @ORM\Column(type="float")
     * @Groups({"weather"})
     */
    private $temp_max;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"weather"})
     */
    private $pressure;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"weather"})
     */
    private $humidity;

    /**
     * @ORM\Column(type="float")
     * @Groups({"weather"})
     */
    private $speed;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"weather"})
     */
    private $deg;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"weather"})
     */
    private $clouds;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"weather"})
     */
    private $pop;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"weather"})
     */
    private $snow;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="weatherLogs")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"city"})
     * @Ignore()
     */
    private $city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDt(): ?int
    {
        return $this->dt;
    }

    public function setDt(int $dt): self
    {
        $this->dt = $dt;

        return $this;
    }

    public function getSunrise(): ?int
    {
        return $this->sunrise;
    }

    public function setSunrise(int $sunrise): self
    {
        $this->sunrise = $sunrise;

        return $this;
    }

    public function getSunset(): ?int
    {
        return $this->sunset;
    }

    public function setSunset(int $sunset): self
    {
        $this->sunset = $sunset;

        return $this;
    }

    public function getTempMin(): ?float
    {
        return $this->temp_min;
    }

    public function setTempMin(float $temp_min): self
    {
        $this->temp_min = $temp_min;

        return $this;
    }

    public function getTempMax(): ?float
    {
        return $this->temp_max;
    }

    public function setTempMax(float $temp_max): self
    {
        $this->temp_max = $temp_max;

        return $this;
    }

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function setTemp(float $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getPressure(): ?int
    {
        return $this->pressure;
    }

    public function setPressure(int $pressure): self
    {
        $this->pressure = $pressure;

        return $this;
    }

    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    public function setHumidity(int $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getSpeed(): ?float
    {
        return $this->speed;
    }

    public function setSpeed(float $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getDeg(): ?int
    {
        return $this->deg;
    }

    public function setDeg(int $deg): self
    {
        $this->deg = $deg;

        return $this;
    }

    public function getClouds(): ?int
    {
        return $this->clouds;
    }

    public function setClouds(int $clouds): self
    {
        $this->clouds = $clouds;

        return $this;
    }

    public function getPop(): ?int
    {
        return $this->pop;
    }

    public function setPop(?int $pop): self
    {
        $this->pop = $pop;

        return $this;
    }

    public function getSnow(): ?float
    {
        return $this->snow;
    }

    public function setSnow(?float $snow): self
    {
        $this->snow = $snow;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
