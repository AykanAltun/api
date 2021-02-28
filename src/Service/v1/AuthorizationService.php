<?php
declare(strict_types=1);

namespace App\Service\v1;

use Symfony\Component\HttpFoundation\Request;

class AuthorizationService
{
    /**
     * Postman header key                   => authorization
     * KernelBrowser(phpunit) header key    => x-session-token
     * OpenApi(Swagger) header key          => X-Request-ID
     * @param Request $request
     * @return string
     */
    public function checkToken(Request $request): string
    {
        if (!$request->headers->get('authorization') && !$request->headers->get('x-session-token')
            && !$request->headers->get('X-Request-ID')) {
            // TODO throw exception
        }
        $bearerToken = explode(
            ' ',
            $request->headers->get('authorization') ?? $request->headers->get('x-session-token')
            ?? $request->headers->get('X-Request-ID')
        );
        if (empty($bearerToken[1])) {
            // TODO throw exception
        }

        return $bearerToken[1];
    }
}
