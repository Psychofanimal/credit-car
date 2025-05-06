<?php

declare(strict_types=1);

namespace App\Controller\API\V1\Request;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Request
{
    /**
     * @param int|null $carId
     * @param int|null $programId
     * @param int|null $initialPayment
     * @param int|null $loanTerm
     */
    public function __construct(
        #[Assert\NotNull(
            message: 'ID автомобиля не может быть пустым ',
        )]
        #[Assert\NotBlank(
            message: 'ID автомобиля обязательно. Было передано: {{ value }}',
            allowNull: true,
        )]
        #[Assert\Type(
            type: 'integer',
            message: 'ID автомобиля не является типом {{ type }}',
        )]
        public ?int $carId = null,

        #[Assert\NotNull(
            message: 'ID кредитной программы не может быть пустым ',
        )]
        #[Assert\NotBlank(
            message: 'ID кредитной программы обязательно. Было передано: {{ value }}',
            allowNull: true,
        )]
        #[Assert\Type(
            type: 'integer',
            message: 'ID кредитной программы не является типом {{ type }}',
        )]
        public ?int $programId = null,

        #[Assert\NotNull(
            message: 'Первоначальный взнос за кредит не указан',
        )]
        #[Assert\NotBlank(
            message: 'Первоначальный взнос за кредит не указан. Было передано: {{ value }}',
            allowNull: true,
        )]
        #[Assert\Type(
            type: 'integer',
            message: 'Первоначальный взнос за кредит не является типом {{ type }}',
        )]
        #[Assert\Length(
            min: 1,
            max: 12,
            minMessage: 'Первоначальный взнос за кредит должен быть хотя бы {{ limit }} знаков',
            maxMessage: 'Первоначальный взнос за кредит не может быть больше {{ limit }} знаков',
        )]
        public ?int $initialPayment = null,

        #[Assert\NotNull(
            message: 'Срок кредита в месяцах не указан',
        )]
        #[Assert\NotBlank(
            message: 'Срок кредита в месяцах не указан. Было передано: {{ value }}',
            allowNull: true,
        )]
        #[Assert\Type(
            type: 'integer',
            message: 'Срок кредита в месяцах не является типом {{ type }}',
        )]
        #[Assert\Length(
            min: 1,
            max: 12,
            minMessage: 'Срок кредита в месяцах должен быть хотя бы {{ limit }} знаков',
            maxMessage: 'Срок кредита в месяцах не может быть больше {{ limit }} знаков',
        )]
        public ?int $loanTerm = null,
    ) {}
}
