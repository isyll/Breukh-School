<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_year_id',
        'student_id',
        'classe_id',
        'date'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class);
    }

    public function years()
    {
        return $this->belongsToMany(SchoolYear::class);
    }
}