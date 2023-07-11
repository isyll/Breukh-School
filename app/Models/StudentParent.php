<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperStudentParent
 */
class StudentParent extends Model
{
    use HasFactory;

    protected $table = 'parents';
}
