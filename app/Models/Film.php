<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'genre',
        'rating',
        'country',
        'media_id',
        'description',
        'release_date',
        'ticket_price',
    ];

    /**
     * Get all film comments
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get film image
     *
     * @return BelongsTo
     */
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
