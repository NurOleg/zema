<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
      'type',
      'path',
    ];

    /**
     * @return MorphTo
     */
    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @param string $path
     * @return string
     */
    public function getPathAttribute(string $path): string
    {
        return Storage::disk('public')->url($path);
    }
}
