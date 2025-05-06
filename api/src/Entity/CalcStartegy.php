<?php

namespace App\Entity;

use App\Repository\CalcStartegyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CalcStartegyRepository::class)]
class CalcStartegy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups([
        'credit_strategy:item',
    ])]
    private ?int $programId = null;

    #[ORM\Column]
    #[Groups([
        'credit_strategy:item',
    ])]
    private ?float $interestRate = null;

    #[ORM\Column]
    #[Groups([
        'credit_strategy:item',
    ])]
    private ?int $monthlyPayment = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([
        'credit_strategy:item',
    ])]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgramId(): ?int
    {
        return $this->programId;
    }

    public function setProgramId(int $programId): static
    {
        $this->programId = $programId;

        return $this;
    }

    public function getInterestRate(): ?float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $interestRate): static
    {
        $this->interestRate = $interestRate;

        return $this;
    }

    public function getMonthlyPayment(): ?int
    {
        return $this->monthlyPayment;
    }

    public function setMonthlyPayment(int $monthlyPayment): static
    {
        $this->monthlyPayment = $monthlyPayment;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
