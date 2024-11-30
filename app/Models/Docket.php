<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Docket extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded;

    protected $casts = [
        'assigned_date' => 'datetime',
        'date_filed' => 'datetime',
    ];

    public function courts()
    {
        return $this->belongsTo(Court::class, 'court_id');
    }

    public function judges()
    {
        return $this->belongsTo(Judge::class, 'judge_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function docketlogs()
    {
        return $this->hasMany(Docketlog::class, 'docket_id', 'id');
    }


    protected static function boot()
    {
        parent::boot();

        // Log the initial creation of the will
        static::created(function ($docket) {
            $fields = [
                'suit_number',
                'case_title',
                'category_id',
                'court_id',
                'location_id',
                'priority_level',
                'date_filed',
            ];

            foreach ($fields as $field) {
                Docketlog::query()->create([
                    'slug' => uniqid(),
                    'docket_id' => $docket->id,
                    'user_id' => $docket->created_by,
                    'activity' => 'Created',
                    'comment' => "Initial value for ".$field. " : " .$docket->$field ?? " not_set"
                ]);
            }
        });

        // Log any updates to specific fields after the will has been created
        static::updated(function ($docket) {
            $fieldsToCheck = [
                'suit_number',
                'case_title',
                'category_id',
                'court_id',
                'location_id',
                'priority_level',
                'status',
                'is_assigned',
                'date_filed',
                'assigned_date',
                'exported',
                'exported_at',
                'disposed_at',
                'disposed_by',
                'created_by',
            ];

            foreach ($fieldsToCheck as $field) {
                // Check if the specific field was modified
                if ($docket->isDirty($field)) {
                    Docketlog::query()->create([
                        'slug' => uniqid(),
                        'docket_id' => $docket->id,
                        'user_id' => $docket->created_by,
                        'activity' => 'Updated',
                        'comment' => "{$field} was changed from " . ($docket->getOriginal($field) ?? 'not_set') . " to " . ($docket->$field ?? 'not_set'),
                    ]);
                }
            }
        });
    }


    public function scopeSearchFullText(Builder $query, $searchTerm)
    {
        return $query->whereRaw(
            "MATCH(suit_number, case_title) AGAINST(? IN NATURAL LANGUAGE MODE)", [$searchTerm]
        )->orderByRaw(
            "MATCH(suit_number, case_title) AGAINST(? IN NATURAL LANGUAGE MODE) DESC", [$searchTerm]
        );
    }



    public static function getDockets()
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin') || !Gate::any(limited_access_level())) {

            $query = static::query();

        }elseif(Gate::any(court_room_access_level())){

            $query = static::query()->whereHas('courts', function ($query) use ($user){
                $query->where('court_id', $user->court_id);
            });

        }else{

            $query = static::query()->whereHas('courts', function ($query) use ($user){
                $query->where('registry_id', $user->registry_id);
            });
        }

        return $query;

    }

}
