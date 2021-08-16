<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respond extends Model
{
    use HasFactory;

    public const STATUS_DONT_LOOKED = 1;
    public const STATUS_ACCEPTED = 2;
    public const STATUS_REJECTED = 3;

    public const STATUS_DONT_LOOKED_NAME = 'Не просмотрен';
    public const STATUS_ACCEPTED_NAME = 'Принят';
    public const STATUS_REJECTED_NAME = 'Отклонен';

    public const STATUSES = [
        self::STATUS_DONT_LOOKED => self::STATUS_DONT_LOOKED_NAME,
        self::STATUS_ACCEPTED => self::STATUS_ACCEPTED_NAME,
        self::STATUS_REJECTED => self::STATUS_REJECTED_NAME,
    ];
}
