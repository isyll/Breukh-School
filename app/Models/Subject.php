<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSubject
 */
class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'subject_group_id',
        'code'
    ];

    public function group()
    {
        return $this->belongsTo(SubjectGroup::class, 'subject_group_id');
    }
}
