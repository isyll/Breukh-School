<?php

namespace App\Models;

use App\Traits\ActiveYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, ActiveYear;

    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'birthdate',
        'birthplace',
        'profile',
        'number'
    ];

    public static function getAvailableNumber()
    {
        $result = Student::selectRaw('MIN(number+1) AS num')
            ->from('students AS s1')
            ->whereNotExists(function ($query) {
                $query->selectRaw(1)
                    ->from('students AS s2')
                    ->whereRaw('s2.number = s1.number + 1 and s2.state = 1');
            })
            ->limit(1)
            ->get()[0];

        if ($result->num === NULL)
            return 1;
        return $result->num;
    }

    public function enrollments()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function parent()
    {
        return $this->belongsTo(StudentParent::class);
    }
}
