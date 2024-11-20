<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courts()
    {
        return $this->belongsToMany(Court::class, 'court_judges')
            ->withPivot('assigned_at', 'unassigned_at')
            ->withTimestamps();
    }

    public function currentCourt()
    {
        return $this->hasOne(CourtJudge::class)
            ->whereNull('unassigned_at')
            ->with('courts');
    }

    public function currentCourts()
    {
        return $this->belongsToMany(Court::class, 'court_judges')
            ->withPivot('assigned_at', 'unassigned_at')
            ->wherePivotNull('unassigned_at');
    }

    public function courttypes()
    {
        return $this->belongsTo(CourtType::class, 'courttype_id');
    }


}
