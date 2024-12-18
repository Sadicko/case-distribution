<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseReassignment extends Model
{
    protected $guarded = [];

    public function approvals()
    {
        return $this->hasMany(CaseReassignmentApproval::class);
    }


    public function dockets()
    {
        return $this->belongsTo(Docket::class, 'docket_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
