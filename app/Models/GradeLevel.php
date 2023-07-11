<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperGradeLevel
 */
class GradeLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }
}
