<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courttype extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'courttype_id');

    }

    public function courts()
    {
        return $this->hasMany(Court::class, 'courttype_id');

    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'courttype_id');

    }
}
