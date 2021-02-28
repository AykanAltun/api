<?php
declare(strict_types=1);

namespace App\Controller\v1;

use App\Controller\AbstractResponse;
use App\Request\v1\Convertor\RegisterConvertor;
use App\Request\v1\RegisterRequest;
use App\Service\v1\Handler\Request\HandlerInterface;
use App\Service\v1\Handler\Validation\ValidatorInterface;
use App\Service\v1\LoginService;
use App\Service\v1\RegisterService;
use App\Service\v1\TokenService;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Post(
 *     path="/api/v1/register",
 *     description="Register a device",
 *     summary="Add a device",
 *     tags={"Study Case"},
 *     operationId="addDevice",
 *     requestBody={"$ref": "#/components/requestBodies/RegisterRequest"},
 *     @OA\Response(response=201, description="Success"),
 *     @OA\Response(response=405, description="Invalid Input"),
 * )
 */
class Register extends AbstractResponse
{
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validationHandler;
    /**
     * @var RegisterService
     */
    private RegisterService $registerService;
    /**
     * @var HandlerInterface
     */
    private HandlerInterface $requestHandler;
    /**
     * @var LoginService
     */
    private LoginService $loginService;
    /**
     * @var TokenService
     */
    private TokenService $tokenService;

    public function __construct(
        ValidatorInterface $validationHandler,
        RegisterService $registerService,
        HandlerInterface $requestHandler,
        LoginService $loginService,
        TokenService $tokenService
    ) {
        $this->validationHandler = $validationHandler;
        $this->registerService = $registerService;
        $this->requestHandler = $requestHandler;
        $this->loginService = $loginService;
        $this->tokenService = $tokenService;
    }

    #[Route("/api/v1/register", methods: ["POST"])]
    public function register(Request $request): JsonResponse
    {
        /** @var RegisterRequest $registerRequest */
        $registerRequest = $this->requestHandler->handle($request, RegisterRequest::class);
        $this->validationHandler->validate($registerRequest);
        $this->registerService->register($registerRequest);

        return $this->success([
            'token' => $this->tokenService->createToken(
                $this->loginService->login(RegisterConvertor::loginRequest($registerRequest))
            )
        ]);
    }
}
