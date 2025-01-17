<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    
    protected $guarded = [];


    public function permissions()
    {
        return $this->hasMany(\Spatie\Permission\Models\Permission::class,'module_id');
    }
}
