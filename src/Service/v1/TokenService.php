<?php
declare(strict_types=1);

namespace App\Service\v1;

use App\Constant\Token;
use App\DTO\v1\ApplicationDTO;
use App\DTO\v1\DeviceDTO;
use App\DTO\v1\LoginDTO;
use \Firebase\JWT\JWT;

class TokenService
{
    public function createToken(LoginDTO $loginDTO): string
    {
        return JWT::encode($loginDTO->toArray(), Token::TOKEN_KEY);
    }

    public function decodeToken(string $token): LoginDTO
    {
        $loginDto = new LoginDTO();
        $decodedToken = (array) JWT::decode($token, Token::TOKEN_KEY, array('HS256'));
        $loginDto->setDevice(DeviceDTO::toDto((array) $decodedToken['device']));
        $loginDto->setApp(ApplicationDTO::toDto((array) $decodedToken['app']));
        $loginDto->setStatus($decodedToken['status']);

        return $loginDto;
    }
}
