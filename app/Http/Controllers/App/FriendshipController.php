<?php


namespace App\Http\Controllers\App;

use App\Http\Requests\App\Friendship\DeleteFriendRequest;
use App\Http\Requests\App\Friendship\ListFriendsRequest;
use App\Http\Requests\App\Friendship\NewFriendshipRequest;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\App\FriendshipService;

final class FriendshipController extends BaseAppController
{
    /**
     * @var FriendshipService
     */
    private FriendshipService $friendshipService;

    /**
     * FriendshipController constructor.
     * @param FriendshipService $friendshipService
     */
    public function __construct(FriendshipService $friendshipService)
    {
        $this->friendshipService = $friendshipService;
    }

    /**
     * @param ListFriendsRequest $request
     * @return JsonResponse
     */
    public function friends(ListFriendsRequest $request): JsonResponse
    {
        $friends = $this->friendshipService->getFriends($request);

        return $this->successResponse($friends);
    }

    /**
     * @param DeleteFriendRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function deleteFriend(DeleteFriendRequest $request, User $user): JsonResponse
    {
        $friendData = $this->friendshipService->deleteFriend($request, $user);

        $deletedFriendFullname = $friendData['deleted_friend']->fullname;

        return $this->successResponse([], $deletedFriendFullname . ' больше не Ваш друг.');
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function requests(User $user): JsonResponse
    {
        $requests = $this->friendshipService->getRequests($user);

        return $this->successResponse($requests);
    }

    /**
     * @param NewFriendshipRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function addRequest(NewFriendshipRequest $request, User $user): JsonResponse
    {
        $friendshipRequest = $this->friendshipService->addRequest($request, $user);

        return $this->successResponse($friendshipRequest, 'Ваша заявка в друзья отправлена.');
    }

    /**
     * @param FriendRequest $friendRequest
     * @return JsonResponse
     */
    public function applyRequest(FriendRequest $friendRequest): JsonResponse
    {
        $result = $this->friendshipService->applyRequest($friendRequest);

        return $this->successResponse($result, 'Заявка в друзья принята.');
    }

    /**
     * @param FriendRequest $friendRequest
     * @return JsonResponse
     */
    public function rejectRequest(FriendRequest $friendRequest): JsonResponse
    {
        $result = $this->friendshipService->rejectRequest($friendRequest);

        return $this->successResponse($result, 'Заявка в друзья отклонена.');
    }
}
