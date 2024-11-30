<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $guarded = [];

    //implements relationship

    public function dockets()
    {
        return $this->hasMany(Docket::class, 'docket_id');
    }

}
