<?php

namespace App\Shared\Infrastructure\Response;

class ApiErrorResponse
{
    public function __construct(
        private readonly bool $success,
        private readonly string $message,
        private readonly int $code,
        private readonly ?array $trace = null
    ) {}

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'code' => $this->code,
            'trace' => $this->trace
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
} 