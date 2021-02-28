<?php
declare(strict_types=1);

namespace App\Persistence\Mysql\Convertor;

use App\DTO\v1\ApplicationDTO;
use App\Entity\v1\Application;

class ApplicationConvertor
{
    public static function toDto(Application $app): ApplicationDTO
    {
        $appDto = new ApplicationDTO();
        $appDto->setAppId($app->getAppId());
        $appDto->setName($app->getName());
        $appDto->setPrice($app->getPrice());
        $appDto->setIsActive($app->isActive());

        return $appDto;
    }
}
