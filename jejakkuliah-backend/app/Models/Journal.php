<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'authors',
        'journal_name',
        'publication_year',
        'doi',
        'abstract',
        'file_path',
    ];

    protected $casts = [
        'publication_year' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}