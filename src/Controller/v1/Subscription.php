<?php
declare(strict_types=1);

namespace App\Controller\v1;

use App\Controller\AbstractResponse;
use App\Service\v1\AuthorizationService;
use App\Service\v1\SubscriptionService;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Get(
 *     path="/api/v1/subscription",
 *     description="Subscription",
 *     summary="Subscription",
 *     tags={"Study Case"},
 *     operationId="subscription",
 *     @OA\Parameter(
 *         name="X-Request-ID",
 *         in="header",
 *         required=true,
 *         description="Bearer {access-token}",
 *         @OA\Schema(
 *              type="string",
 *              schema="bearer"
 *         ),
 *      ),
 *     security={{"Bearer":{}}},
 *     @OA\Response(response=201, description="Success"),
 *     @OA\Response(response=405, description="Invalid Input"),
 * )
 */
class Subscription extends AbstractResponse
{
    /**
     * @var SubscriptionService
     */
    private SubscriptionService $subscriptionService;
    /**
     * @var AuthorizationService
     */
    private AuthorizationService $authorizationService;

    public function __construct(SubscriptionService $subscriptionService, AuthorizationService $authorizationService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->authorizationService = $authorizationService;
    }

    #[Route("/api/v1/subscription", methods: ["GET"])]
    public function subscription(Request $request): JsonResponse
    {
        return $this->success(['status' => $this->subscriptionService->getSubscriptionStatus(
            $this->authorizationService->checkToken($request)
        )]);
    }
}
