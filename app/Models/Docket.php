<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
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

}
