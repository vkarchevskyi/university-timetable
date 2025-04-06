<?php

declare(strict_types=1);

namespace App\Exceptions\Banks\Monobank;

use App\Exceptions\BusinessException;
use Throwable;

final class MonobankApiException extends BusinessException
{
    /**
     * @param array<string, string> $params
     */
    public function __construct(
        string $message = 'exceptions.monobank.api.error',
        array $params = [],
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(__($message, $params), $code, $previous);
    }
}
