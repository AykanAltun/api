<?php
declare(strict_types=1);

namespace App\Service\v1\Handler\Request;

use App\Request\RequestInterface;
use Symfony\Component\HttpFoundation\Request;

class Handler implements HandlerInterface
{
    public function handle(Request $request, string $class): RequestInterface
    {
        $content = json_decode($request->getContent(), true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            // TODO throw exception
        }
        $requestInterface = new $class();
        if (!$requestInterface instanceof RequestInterface) {
            // TODO throw exception
        }
        $requestInterface->fill($content);

        return $requestInterface;
    }
}
