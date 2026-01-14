<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'author',
        'publisher',
        'publication_year',
        'isbn',
        'description',
        'cover_image',
    ];

    protected $casts = [
        'publication_year' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
