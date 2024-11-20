<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function regions()
    {
        return $this->belongsTo(Region::class, 'region_id');

    }

    public function courttypes()
    {
        return $this->belongsTo(Courttype::class, 'courttype_id');

    }

    public function courts()
    {
        return $this->hasMany(Court::class, 'location_id');

    }
    public function assets()
    {
        return $this->hasMany(Asset::class, 'location_id');
    }

}
