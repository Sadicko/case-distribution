<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courttypes()
    {
        return $this->belongsTo(Courttype::class, 'courttype_id');
    }

    public function courts()
    {
        return $this->belongsToMany(Court::class, 'court_categories')
            ->withPivot('created_by');
    }

    public function registries()
    {
        return $this->belongsToMany(Registry::class, 'registry_categories')
            ->withPivot('created_by');
    }

    public function dockets()
    {
        return $this->hasMany(Docket::class, 'category_id');

    }

    public static function fetchCategoriesWithCourt()
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin') || !Gate::any(limited_access_level())) {

            $query = static::query()->whereHas('courts', function ($qeury) {
                $qeury->where('availability', 1);
            });

        } elseif (Gate::any(court_room_access_level())) {

            $query = static::query()->whereHas('courts', function ($query) use ($user) {
                $query->where('court_id', $user->court_id)
                    ->where('availability', 1);
            });

        } else {

            $query = static::query()->whereHas('courts', function ($query) use ($user) {
                $query->where('registry_id', $user->registry_id)
                    ->where('availability', 1);
            });
        }

        return $query;

    }

    public static function getCategories()
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin') || !Gate::any(limited_access_level())) {

            $query = static::query()->whereHas('courts');

        } elseif (Gate::any(court_room_access_level())) {

            $query = static::query()->whereHas('courts', function ($query) use ($user) {
                $query->where('court_id', $user->court_id);
            });

        } else {

            $query = static::query()->whereHas('courts', function ($query) use ($user) {
                $query->where('registry_id', $user->registry_id);
            });
        }

        return $query;

    }


}
