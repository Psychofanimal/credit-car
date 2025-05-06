<?php

declare(strict_types=1);

namespace App\Controller\API\V1\Credit\Calculate;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Request
{
    /**
     * @param string|null $price
     * @param string|null $initialPayment
     * @param string|null $loanTerm
     */
    public function __construct(
        #[Assert\NotNull(
            message: 'Цена не указана',
        )]
        #[Assert\NotBlank(
            message: 'Цена не указана. Было передано: {{ value }}',
            allowNull: true,
        )]
        #[Assert\Length(
            min: 1,
            max: 12,
            minMessage: 'Цена должна быть хотя бы {{ limit }} знаков',
            maxMessage: 'Цена не может быть больше {{ limit }} знаков',
        )]
        public ?string $price = null,

        #[Assert\NotNull(
            message: 'Первоначальный взнос за кредит не указан',
        )]
        #[Assert\NotBlank(
            message: 'Первоначальный взнос за кредит не указан. Было передано: {{ value }}',
            allowNull: true,
        )]
        #[Assert\Length(
            min: 1,
            max: 12,
            minMessage: 'Первоначальный взнос за кредит должен быть хотя бы {{ limit }} знаков',
            maxMessage: 'Первоначальный взнос за кредит не может быть больше {{ limit }} знаков',
        )]
        public ?string $initialPayment = null,

        #[Assert\NotNull(
            message: 'Срок кредита в месяцах не указан',
        )]
        #[Assert\NotBlank(
            message: 'Срок кредита в месяцах не указан. Было передано: {{ value }}',
            allowNull: true,
        )]
        #[Assert\Length(
            min: 1,
            max: 12,
            minMessage: 'Срок кредита в месяцах должен быть хотя бы {{ limit }} знаков',
            maxMessage: 'Срок кредита в месяцах не может быть больше {{ limit }} знаков',
        )]
        public ?string $loanTerm = null,
    ) {}
}
