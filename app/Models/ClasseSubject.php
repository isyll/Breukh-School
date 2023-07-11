<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperClasseSubject
 */
class ClasseSubject extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'classe_subject';
}
