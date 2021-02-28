<?php

namespace App\Service\v1\Handler\Request;

use App\Request\RequestInterface;
use Symfony\Component\HttpFoundation\Request;

interface HandlerInterface
{
    /**
     * @param Request $request
     * @param string $class
     * @return RequestInterface
     */
    public function handle(Request $request, string $class): RequestInterface;
}
