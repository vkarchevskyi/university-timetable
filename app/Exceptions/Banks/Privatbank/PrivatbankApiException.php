<?php

declare(strict_types=1);

namespace App\Exceptions\Banks\Privatbank;

use App\Exceptions\BusinessException;
use Throwable;

final class PrivatbankApiException extends BusinessException
{
    /**
     * @param array<string, int|string> $params
     */
    public function __construct(
        string $message = 'exceptions.privatbank.api.error',
        array $params = [],
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(__($message, $params), $code, $previous);
    }
}
