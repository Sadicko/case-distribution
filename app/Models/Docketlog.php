<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docketlog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function wills()
    {
        return $this->belongsTo(Docket::class, 'docket_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
