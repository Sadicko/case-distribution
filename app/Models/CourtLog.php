<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtLog extends Model
{
    protected $guarded = [];

    public function courts()
    {
        return $this->belongsTo(Court::class, 'court_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
