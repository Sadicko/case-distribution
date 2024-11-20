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


//    public static function getCourt()
//    {
//        if (Gate::any(['manage_system', 'general_admin'])) {
//
//            $bails =  static::query();
//
//        }elseif (Gate::any(['court_registrar', 'court_staff'])) {
//
//            $bails =  static::query()->where('registry_id', Auth::user()->registry_id);
//
//        }
//
//        return $bails;
//    }
}
