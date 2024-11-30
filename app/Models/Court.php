<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class Court extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function courttypes()
    {
        return $this->belongsTo(Courttype::class, 'courttype_id');
    }

    public function registries()
    {
        return $this->belongsTo(Registry::class, 'registry_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'court_id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function regions()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }


    public function judges()
    {
        return $this->belongsToMany(Judge::class, 'court_judges')
            ->withPivot('assigned_at', 'unassigned_at')
            ->withTimestamps();
    }

    public function currentJudge()
    {
        return $this->belongsToMany(Judge::class, 'court_judges')
            ->withPivot('assigned_at', 'unassigned_at')
            ->wherePivotNull('unassigned_at');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'court_categories')
            ->withPivot('created_by')
            ->withTimestamps();
    }

    public static function getCourts()
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin') || !Gate::any(limited_access_level())) {

            $query = static::query()->where('availability', 1);

        }elseif(Gate::any(court_room_access_level())){

            $query = static::query()->where('id', $user->court_id)->where('availability', 1);

        }else{

            $query = static::query()->where('registry_id', $user->registry_id)->where('availability', 1);
        }

        return $query;

    }
}
