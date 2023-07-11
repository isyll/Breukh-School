<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperEnrollment
 */
class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_year_id',
        'student_id',
        'classe_id',
        'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function year()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function notes()
    {
        return $this->belongsToMany(Note::class, 'notes', 'enrollment_id', 'classe_subject_id');
    }
}
