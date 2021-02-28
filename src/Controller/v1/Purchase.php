<?php
declare(strict_types=1);

namespace App\Controller\v1;

use App\Controller\AbstractResponse;
use App\Service\v1\AuthorizationService;
use App\Service\v1\Handler\Request\HandlerInterface;
use App\Service\v1\PurchaseService;
use OpenApi\Annotations as OA;
use App\Request\v1\PurchaseRequest;
use App\Service\v1\Handler\Validation\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Post(
 *     path="/api/v1/purchase",
 *     description="Purchase a product",
 *     summary="Purchase a product",
 *     tags={"Study Case"},
 *     operationId="purchaseProduct",
 *     requestBody={"$ref": "#/components/requestBodies/PurchaseRequest"},
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
class Purchase extends AbstractResponse
{
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validationHandler;
    /**
     * @var HandlerInterface
     */
    private HandlerInterface $requestHandler;
    /**
     * @var PurchaseService
     */
    private PurchaseService $purchaseService;
    /**
     * @var AuthorizationService
     */
    private AuthorizationService $authorizationService;

    public function __construct(
        ValidatorInterface $validationHandler,
        HandlerInterface $requestHandler,
        PurchaseService $purchaseService,
        AuthorizationService $authorizationService
    ) {
        $this->validationHandler = $validationHandler;
        $this->requestHandler = $requestHandler;
        $this->purchaseService = $purchaseService;
        $this->authorizationService = $authorizationService;
    }

    #[Route("/api/v1/purchase", methods: ["POST"])]
    public function purchase(Request $request): JsonResponse
    {
        /** @var PurchaseRequest $purchaseRequest */
        $purchaseRequest = $this->requestHandler->handle($request, PurchaseRequest::class);
        $this->validationHandler->validate($purchaseRequest);

        return $this->success((
            $this->purchaseService->purchase(
                $purchaseRequest,
                $this->authorizationService->checkToken($request)
            )
        )->toArray());
    }
}
