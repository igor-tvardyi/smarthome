<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SensorDataRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class SensorData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(name="t", type="smallint")
     * @Assert\NotNull()
     */
    protected $temperature;

    /**
     * @var int
     * @ORM\Column(name="h", type="smallint")
     * @Assert\NotNull()
     */
    protected $humidity;

    /**
     * @var int
     * @ORM\Column(name="b", type="smallint", nullable=true)
     */
    protected $pressure;

    /**
     * @var Sensor
     * @ORM\ManyToOne(targetEntity="App\Entity\Sensor")
     * @ORM\JoinColumn(name="sensor_id", onDelete="CASCADE")
     */
    protected $sensor;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return (float) ($this->temperature / 100);
    }

    /**
     * @param float $temperature
     * @return SensorData
     */
    public function setTemperature($temperature): SensorData
    {
        $this->temperature = (int) ($temperature * 100);
        return $this;
    }

    /**
     * @return float
     */
    public function getHumidity(): float
    {
        return (float) ($this->humidity / 100);
    }

    /**
     * @param float $humidity
     * @return SensorData
     */
    public function setHumidity($humidity): SensorData
    {
        $this->humidity = (int) ($humidity * 100);
        return $this;
    }

    /**
     * @return float
     */
    public function getPressure(): float
    {
        return (float) ($this->pressure / 100);
    }

    /**
     * @param float $pressure
     * @return SensorData
     */
    public function setPressure($pressure): SensorData
    {
        $this->pressure = (int) ($pressure * 100);
        return $this;
    }

    /**
     * @return Location
     */
    public function getSensor(): ?Sensor
    {
        return $this->sensor;
    }

    /**
     * @param Sensor $sensor
     * @return SensorData
     */
    public function setSensor(Sensor $sensor): SensorData
    {
        $this->sensor = $sensor;
        return $this;
    }
}
