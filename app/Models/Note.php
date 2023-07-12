<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperNote
 */
class Note extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}