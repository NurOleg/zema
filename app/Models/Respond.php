<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        self::STATUS_ACCEPTED    => self::STATUS_ACCEPTED_NAME,
        self::STATUS_REJECTED    => self::STATUS_REJECTED_NAME,
    ];

    protected $fillable = [
        'resume_id',
        'vacancy_id',
        'letter',
        'status'
    ];

    /**
     * @return BelongsTo
     */
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }

    /**
     * @return BelongsTo
     */
    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }
}
