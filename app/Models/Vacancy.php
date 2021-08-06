<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'salary_from',
        'salary_to',
        'user_id',
        'category_id',
        'employment_type_id',
        'experience_id',
        'city_id',
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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return BelongsTo
     */
    public function employment_type(): BelongsTo
    {
        return $this->belongsTo(EmploymentType::class);
    }

    /**
     * @return BelongsTo
     */
    public function experience(): BelongsTo
    {
        return $this->belongsTo(Experience::class);
    }
}
