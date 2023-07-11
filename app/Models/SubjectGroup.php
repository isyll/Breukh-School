<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSubjectGroup
 */
class SubjectGroup extends Model
{
    use HasFactory;

    protected $table = 'subject_groups';

    public $timestamps = false;

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}