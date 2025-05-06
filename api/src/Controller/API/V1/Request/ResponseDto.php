<?php

declare(strict_types=1);

namespace App\Controller\API\V1\Request;

final class ResponseDto
{
    private bool $success;
    public function __construct(
    ) {
        $this->success = false;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }
}
