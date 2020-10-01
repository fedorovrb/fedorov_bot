<?php

namespace App\Entity;

use App\Repository\RatesEntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RatesEntityRepository::class)
 */
class RatesEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $euro;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $usd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $bank;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEuro(): ?string
    {
        return $this->euro;
    }

    public function setEuro(string $euro): self
    {
        $this->euro = $euro;

        return $this;
    }

    public function getUsd(): ?string
    {
        return $this->usd;
    }

    public function setUsd(string $usd): self
    {
        $this->usd = $usd;

        return $this;
    }

    public function getBank(): ?string
    {
        return $this->bank;
    }

    public function setBank(string $bank): self
    {
        $this->bank = $bank;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
