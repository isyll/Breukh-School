<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSchoolYear
 */
class SchoolYear extends Model
{
    use HasFactory;

    public static function currentYear()
    {
        return self::where("state", 1)->first();
    }
}