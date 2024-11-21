<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected  $guarded = [];

    public function courttypes()
    {
        return $this->belongsTo(Courttype::class, 'courttype_id');
    }

    public function courts()
    {
       return $this->belongsToMany(Court::class, 'court_categories')
            ->withPivot( 'created_by');
    }

    public function dockets()
    {
        return $this->hasMany(Docket::class, 'category_id');

    }


}
