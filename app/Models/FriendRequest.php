<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FriendRequest extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id', // юзер, который запрашивает дружбу
        'requested_friend_id' // юзер, которому приходит запрос в друзья
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function requested_friend(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_friend_id', 'id');
    }
}
