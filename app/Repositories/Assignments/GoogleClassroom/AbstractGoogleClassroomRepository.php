<?php

declare(strict_types=1);

namespace App\Repositories\Assignments\GoogleClassroom;

use App\Exceptions\Assignments\GoogleClassroom\ApiAuthenticationException;
use App\Exceptions\Assignments\GoogleClassroom\ApiException;
use App\Models\User;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use JsonException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

abstract readonly class AbstractGoogleClassroomRepository
{
    public function __construct(protected Factory $http)
    {
    }

    /**
     * @throws JsonException
     * @throws ApiAuthenticationException
     * @throws ApiException
     */
    final protected function checkResponseStatus(Response $response): void
    {
        if ($response->status() === SymfonyResponse::HTTP_UNAUTHORIZED) {
            /** @var object{code: int, message: string, status: string} $errorData */
            $errorData = json_decode($response->body(), flags: JSON_THROW_ON_ERROR)->error;

            throw new ApiAuthenticationException($errorData->message, $errorData->code);
        }

        if (!$response->successful()) {
            throw new ApiException("Unsuccessful request. Status 200 expected, {$response->status()} received");
        }
    }

    final protected function getUser(): User
    {
        return User::googleServiceAccount()->firstOrFail();
    }
}
