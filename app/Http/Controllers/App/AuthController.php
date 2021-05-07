<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\App\BaseAppController;
use App\Http\Requests\App\Auth\GetTokenRequest;
use App\Http\Requests\App\Auth\RegisterRequest;
use App\Http\Requests\App\Auth\VerifyRequest;
use App\Services\App\AuthService;
use Illuminate\Http\JsonResponse;

final class AuthController extends BaseAppController
{
    /**
     * @var AuthService
     */
    private AuthService $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request);

        return $this->successResponse([], $result);
    }

    /**
     * @param GetTokenRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function token(GetTokenRequest $request)
    {
        $token = $this->authService->getToken($request);

        return $this->successResponse($token, 'Добро пожаловать!');
    }

    /**
     * @param VerifyRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function verify(VerifyRequest $request)
    {
        $data = $this->authService->verify($request);

        return $this->successResponse($data, 'Добро пожаловать!');
    }
}
