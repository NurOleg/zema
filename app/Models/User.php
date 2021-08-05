<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    public const EDUCATION = [
        'Нет',
        'Среднее',
        'Среднее специальное',
        'Неоконченное высшее',
        'Высшее',
        'Бакалавр',
        'Магистр',
        'Кандидат наук',
        'Доктор наук',
    ];

    public const GENDER = [
        'Мужской',
        'Женский',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'verified',
        'email',
        'password',
        'education',
        'help_needed',
        'help_offer',
        'areas_of_interest',
        'career',
        'age',
        'name',
        'surname',
        'patronymic',
        'gender',
        'avatar',
        'birth_city_id',
        'current_city_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    /**
     * @return BelongsToMany
     */
    public function friend_requests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'requested_friend_id', 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function current_city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'current_city_id');
    }

    /**
     * @return BelongsTo
     */
    public function birth_city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'birth_city_id');
    }

    /**
     * @return HasMany
     */
    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    /**
     * @return ?string
     */
    public function getAvatarAttribute(): ?string
    {
        return !empty($this->attributes['avatar'])
            ? Storage::disk('public')->url($this->attributes['avatar'])
            : null;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->attributes['surname'] . ' ' . $this->attributes['name'];
    }
}
