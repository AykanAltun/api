<?php

namespace App\Service\v1\Handler\Validation;

use App\Request\RequestInterface;

interface ValidatorInterface
{
    /**
     * @param RequestInterface $requestI
     */
    public function validate(RequestInterface $requestI): void;
}