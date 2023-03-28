<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'hash',
        'size',
        'name',
        'extention',
    ];

    /**
     * The url attribute modifier.
     *
     * @param string $value
     * @return string
     */
    public function getUrlAttribute($value)
    {
        return Storage::url($value);
    }
}
