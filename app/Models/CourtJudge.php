<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtJudge extends Model
{
    use HasFactory;

    protected $casts = [
        "assigned_at" => "datetime",
    ];

    //    public function courts()
//    {
//        return $this->belongsTo(Court::class, 'court_id');
//    }
//
//    public function judges()
//    {
//        return $this->belongsTo(Judge::class, 'judge_id');
//    }
}
