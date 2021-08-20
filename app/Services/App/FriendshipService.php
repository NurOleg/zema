<?php


namespace App\Services\App;


use App\Http\Requests\App\Friendship\DeleteFriendRequest;
use App\Http\Requests\App\Friendship\ListFriendsRequest;
use App\Http\Requests\App\Friendship\NewFriendshipRequest;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final class FriendshipService
{
    /**
     * @param ListFriendsRequest $request
     * @return array
     */
    public function getFriends(ListFriendsRequest $request): array
    {
        $friendsQuery = User::query();

        if ($request->filled('birth_city_id')) {
            $friendsQuery->where('birth_city_id', $request->get('birth_city_id'));
        }

        if ($request->filled('current_city_id')) {
            $friendsQuery->where('current_city_id', $request->get('current_city_id'));
        }

        if ($request->filled('age_from')) {
            $friendsQuery->where('age', '>=', $request->get('age_from'));
        }

        if ($request->filled('age_to')) {
            $friendsQuery->where('age', '<=', $request->get('age_to'));
        }

        if ($request->filled('friends_for_user_id')) {
            $friendIds = Friend::where(['user_id' => $request->get('friends_for_user_id')])->get('friend_id')->toArray();
            $friends = $friendsQuery->findMany($friendIds);
        }

        $friends = isset($friends) && $friends instanceof Collection ? $friends : $friendsQuery->get();

        return ['users' => $friends];
    }

    /**
     * @param DeleteFriendRequest $request
     * @param User $user
     * @return array
     */
    public function deleteFriend(DeleteFriendRequest $request, User $user): array
    {
        $friendId = $request->get('deleted_friend_id');

        Friend::where(['user_id' => $user->id, 'friend_id' => $friendId])->delete();
        Friend::where(['friend_id' => $user->id, 'user_id' => $friendId])->delete();

        return ['deleted_friend' => User::find($friendId)];
    }

    /**
     * @param User $user
     * @return array
     */
    public function getRequests(User $user): array
    {
        $requests = FriendRequest::with('user')->where('requested_friend_id', $user->id)->get();

        return ['friend_requests' => $requests];
    }

    /**
     * @param NewFriendshipRequest $request
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function addRequest(NewFriendshipRequest $request, User $user): array
    {
        $requestedFriendId = $request->get('requested_friend_id');

        if ((int)$requestedFriendId === $user->id) {
            throw new \Exception('Нельзя дружить с самим собой.');
        }

        if (FriendRequest::where([
            'user_id'             => $user->id,
            'requested_friend_id' => $requestedFriendId
        ])->exists()) {
            throw new \Exception('Запрос в друзья между этими пользователями уже существует.');
        }

        if (Friend::where([
            'user_id'   => $user->id,
            'friend_id' => $requestedFriendId
        ])->exists()) {
            throw new \Exception('Нельзя отправить запрос, т.к. вы уже друзья.');
        }

        $friendRequest = FriendRequest::create([
            'user_id'             => $user->id, // юзер, который запрашивает дружбу
            'requested_friend_id' => $request->get('requested_friend_id') // юзер, которому приходит запрос в друзья
        ]);

        return ['request' => $friendRequest];
    }

    /**
     * @param FriendRequest $friendRequest
     * @return array
     */
    public function applyRequest(FriendRequest $friendRequest): array
    {
        Friend::create([
            'user_id'   => $friendRequest->user_id,
            'friend_id' => $friendRequest->requested_friend_id
        ]);

        Friend::create([
            'friend_id' => $friendRequest->user_id,
            'user_id'   => $friendRequest->requested_friend_id
        ]);

        $friendRequest->delete();

        return [];
    }

    /**
     * @param FriendRequest $friendRequest
     * @return array
     */
    public function rejectRequest(FriendRequest $friendRequest): array
    {
        $friendRequest->delete();

        return [];
    }
}
