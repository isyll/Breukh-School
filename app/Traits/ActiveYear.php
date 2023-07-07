<?php

namespace App\Traits;

use App\Models\SchoolYear;

trait ActiveYear
{
    /**
     * Returns th current active year.
     */
    public function activeYear($column = '*')
    {
        return SchoolYear::where('state', 1)->first($column);
    }
}
