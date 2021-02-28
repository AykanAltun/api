<?php
declare(strict_types=1);

namespace App\Request\v1\Convertor;

use App\Request\v1\LoginRequest;
use App\Request\v1\RegisterRequest;

class RegisterConvertor
{
    public static function loginRequest(RegisterRequest $registerRequest): LoginRequest
    {
        $loginRequest = new LoginRequest();
        $loginRequest->setUid($registerRequest->getUid());
        $loginRequest->setAppId($registerRequest->getAppId());

        return $loginRequest;
    }
}
