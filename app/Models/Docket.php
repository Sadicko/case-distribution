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
}
