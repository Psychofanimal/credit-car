<?php

namespace App\Entity;

use App\Repository\RequestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestRepository::class)]
class Request
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Property $car_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CalcStartegy $program_id = null;

    #[ORM\Column]
    private ?int $initialPayment = null;

    #[ORM\Column]
    private ?int $loanTerm = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarId(): ?Property
    {
        return $this->car_id;
    }

    public function setCarId(?Property $car_id): static
    {
        $this->car_id = $car_id;

        return $this;
    }

    public function getProgramId(): ?CalcStartegy
    {
        return $this->program_id;
    }

    public function setProgramId(?CalcStartegy $program_id): static
    {
        $this->program_id = $program_id;

        return $this;
    }

    public function getInitialPayment(): ?int
    {
        return $this->initialPayment;
    }

    public function setInitialPayment(int $initialPayment): static
    {
        $this->initialPayment = $initialPayment;

        return $this;
    }

    public function getLoanTerm(): ?int
    {
        return $this->loanTerm;
    }

    public function setLoanTerm(int $loanTerm): static
    {
        $this->loanTerm = $loanTerm;

        return $this;
    }
}
