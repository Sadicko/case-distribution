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
        return $this->belongsToMany(Court::class, 'court_judges')
            ->withPivot('assigned_at', 'unassigned_at')
            ->wherePivotNull('unassigned_at');
    }
}
