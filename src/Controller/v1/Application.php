<?php
declare(strict_types=1);

namespace App\Controller\v1;

use App\Controller\AbstractResponse;
use App\Persistence\Mysql\Service\ApplicationPersistenceService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\v1\Application as ApplicationEntity;

/**
 * Sadece test için yazılmıştır.
 * @deprecated
 */
class Application extends AbstractResponse
{
    /**
     * @var ApplicationPersistenceService
     */
    private ApplicationPersistenceService $applicationPersistenceService;

    public function __construct(ApplicationPersistenceService $applicationPersistenceService)
    {
        $this->applicationPersistenceService = $applicationPersistenceService;
    }

    /**
     * Testlerin çalışabilmesi için kayıtlı application olması gerekmektedir.
     * Bu class bu amaçla oluşturulmuştur.
     */
    #[Route("/api/v1/application", methods: ["POST"])]
    public function application(): JsonResponse
    {
        $appId = rand(0, 1000000);
        $application = new ApplicationEntity();
        $application->setAppId($appId);
        $application->setName('Test Application '.$appId);
        $application->setPrice(rand(0, 1000));
        $application->setIsActive(true);
        $this->applicationPersistenceService->save($application);

        return $this->success(['appId' => $appId]);
    }
}
