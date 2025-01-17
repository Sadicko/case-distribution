<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Comment\Doc;

class Judge extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function dockets()
    {
        return $this->hasMany(Docket::class, 'judge_id');
    }
    public function courts()
    {
        return $this->belongsToMany(Court::class, 'court_judges')
            ->withPivot('assigned_at', 'unassigned_at')
            ->withTimestamps();
    }

    public function currentCourt()
    {
        return $this->belongsToMany(Court::class, 'court_judges')
            ->withPivot('assigned_at', 'unassigned_at')
            ->wherePivotNull('unassigned_at')
            ->limit(1);
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_id');
    }
}
