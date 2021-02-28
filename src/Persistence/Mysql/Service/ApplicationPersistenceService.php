<?php
declare(strict_types=1);

namespace App\Persistence\Mysql\Service;

use App\DTO\v1\ApplicationDTO;
use App\Entity\v1\Application;
use App\Exception\ApplicationNotFoundException;
use App\Persistence\Mysql\Convertor\ApplicationConvertor;
use Doctrine\ORM\EntityManagerInterface;

class ApplicationPersistenceService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getApplication(int $appId): ApplicationDTO
    {
        /** @var Application $app */
        $app = $this->entityManager->getRepository(Application::class)->find($appId);
        if (empty($app)) {
            throw new ApplicationNotFoundException("Uygulama bulunamadı.");
        }

        return ApplicationConvertor::toDto($app);
    }

    /**
     * Testlerin çalışabilmesi için kayıtlı application olması gerekmektedir.
     * @deprecated
     * @param Application $application
     */
    public function save(Application $application): void
    {
        $this->entityManager->persist($application);
        $this->entityManager->flush();
    }
}
