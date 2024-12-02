<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $guarded = [];

    //implements relationship

    public function dockets()
    {
        return $this->belongsTo(Docket::class, 'docket_id');
    }

}
