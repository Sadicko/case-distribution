<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public function assets()
    {
        return $this->hasMany(Asset::class, 'region_id');

    }

    public function courts()
    {
        return $this->hasMany(Court::class, 'region_id');

    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id');

    }

}
