<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;


/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"serialize"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"serialize"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"serialize"})
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=WeatherLog::class, mappedBy="city")
     * @Ignore()
     */
    private $weatherLogs;

    public function __construct()
    {
        $this->weatherLogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|WeatherLog[]
     */
    public function getWeatherLogs(): Collection
    {
        return $this->weatherLogs;
    }

    public function addWeatherLog(WeatherLog $weatherLog): self
    {
        if (!$this->weatherLogs->contains($weatherLog)) {
            $this->weatherLogs[] = $weatherLog;
            $weatherLog->setCity($this);
        }

        return $this;
    }

    public function removeWeatherLog(WeatherLog $weatherLog): self
    {
        if ($this->weatherLogs->removeElement($weatherLog)) {
            // set the owning side to null (unless already changed)
            if ($weatherLog->getCity() === $this) {
                $weatherLog->setCity(null);
            }
        }

        return $this;
    }
}
