<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester_id',
        'name',
        'code',
        'credits',
        'lecturer',
        'description',
    ];

    protected $casts = [
        'credits' => 'integer',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}