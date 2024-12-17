<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseReassignmentApproval extends Model
{
    protected $guarded = [];

    public function reassignment()
    {
        return $this->belongsTo(CaseReassignment::class, 'case_reassignment_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
