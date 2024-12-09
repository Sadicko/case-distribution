<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Registry extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'registry_id');
    }

    public function  locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function  regions()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function  courts()
    {
        return $this->hasMany(Court::class, 'registry_id');
    }

    public static function fetchRegistry()
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin') || !Gate::any(limited_access_level())) {

            $query = static::query();
        } else {

            $query = static::query()->where('id', $user->registry_id);
        }

        return $query;
    }
}
