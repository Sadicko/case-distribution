<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'assigned_date' => 'datetime'
    ];
    //implements relationship

    public function dockets()
    {
        return $this->belongsTo(Docket::class, 'docket_id');
    }

    public function courts()
    {
        return $this->belongsTo(Court::class, 'court_id');
    }

    public function judges()
    {
        return $this->belongsTo(Judge::class, 'judge_id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

}
