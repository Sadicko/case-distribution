<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    public function registries()
    {
        return $this->hasMany(Registry::class, 'location_id');
    }


    public static function fetchLocationsWithCourt()
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin') || !Gate::any(limited_access_level())) {

            $query = static::query()->whereHas('courts', function ($qeury) {
                $qeury->where('availability', 1);
            });
        } else {

            $query = static::query()->whereHas('courts', function ($locationQeury) use ($user) {
                $locationQeury->where('registry_id', $user->registry_id)
                    ->where('availability', 1);
            });
        }

        return $query;
    }

    public static function fetchLocations()
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin') || !Gate::any(limited_access_level())) {

            $query = static::query()->whereHas('courts');
        } else {

            $query = static::query()->whereHas('courts', function ($locationQeury) use ($user) {
                $locationQeury->where('registry_id', $user->registry_id);
            });
        }

        return $query;
    }
}
