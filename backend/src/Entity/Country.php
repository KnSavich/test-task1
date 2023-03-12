<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 * @ORM\Table(name="countries")
 */
class Country
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column(name="country_code", type="string", length=2)
     */
    private string $countryCode;

    /**
     * @var float
     * @ORM\Column(name="tax_percentage", type="integer")
     */
    private float $taxPercentage;

    /**
     * @param string $name
     * @param string $countryCode
     * @param float $taxPercentage
     */
    public function __construct(string $name, string $countryCode, float $taxPercentage)
    {
        $this->name = $name;
        $this->countryCode = $countryCode;
        $this->taxPercentage = $taxPercentage;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getTaxPercentage(): int
    {
        return $this->taxPercentage;
    }
}