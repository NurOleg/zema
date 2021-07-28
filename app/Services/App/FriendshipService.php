<?php


namespace App\Services\App;


use App\Models\User;

final class FriendshipService
{
    /**
     * @param User $user
     * @return array
     */
    public function get(User $user): array
    {
        $user->load('friends');
        $friends = $user->friends;

        return ['friends' => $friends];
    }

    /**
     * @param User $user
     * @return array
     */
    public function getRequests(User $user): array
    {
        $user->load('friend_requests');
        $requests = $user->friend_requests;

        return ['requests' => $requests];
    }
}
