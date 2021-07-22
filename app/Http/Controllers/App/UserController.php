<?php

namespace App\Http\Controllers\App;

use App\Models\User;
use App\Services\App\UserService;
use App\Http\Requests\App\User\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserController extends BaseAppController
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function show(Request $request, User $user): JsonResponse
    {
        $user = $this->userService->show($user);

        return $this->successResponse($user);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user = $this->userService->update($request, $user);

        return $this->successResponse($user, 'Ваш профиль успешно обновлён!');
    }

    public function edit(Request $request, User $user): JsonResponse
    {
        $user = $this->userService->show($user);
        $educations = User::EDUCATION;
        $genders = User::GENDER;

        return $this->successResponse(array_merge($user, ['genders' => $genders, 'educations' => $educations]));
    }
}
