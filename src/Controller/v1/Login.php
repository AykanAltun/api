<?php
declare(strict_types=1);

namespace App\Controller\v1;

use App\Controller\AbstractResponse;
use App\Request\v1\LoginRequest;
use App\Service\v1\Handler\Request\HandlerInterface;
use App\Service\v1\Handler\Validation\ValidatorInterface;
use App\Service\v1\LoginService;
use App\Service\v1\TokenService;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Post(
 *     path="/api/v1/login",
 *     description="Login",
 *     summary="Login",
 *     tags={"Study Case"},
 *     operationId="login",
 *     requestBody={"$ref": "#/components/requestBodies/LoginRequest"},
 *     @OA\Response(response=201, description="Success"),
 *     @OA\Response(response=405, description="Invalid Input"),
 * )
 */
class Login extends AbstractResponse
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
     * @var LoginService
     */
    private LoginService $loginService;
    /**
     * @var TokenService
     */
    private TokenService $tokenService;

    public function __construct(
        ValidatorInterface $validationHandler,
        HandlerInterface $requestHandler,
        LoginService $loginService,
        TokenService $tokenService
    ) {
        $this->validationHandler = $validationHandler;
        $this->requestHandler = $requestHandler;
        $this->loginService = $loginService;
        $this->tokenService = $tokenService;
    }

    #[Route("/api/v1/login", methods: ["POST"])]
    public function login(Request $request): JsonResponse
    {
        /** @var LoginRequest $loginRequest */
        $loginRequest = $this->requestHandler->handle($request, LoginRequest::class);
        $this->validationHandler->validate($loginRequest);

        return $this->success(['token' => $this->tokenService->createToken($this->loginService->login($loginRequest))]);
    }
}
