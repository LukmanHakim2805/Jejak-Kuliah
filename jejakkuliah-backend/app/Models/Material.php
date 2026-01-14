<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'type',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'url',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}