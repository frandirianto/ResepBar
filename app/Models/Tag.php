<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function recipeTags(){
        return $this->belongsToMany('App\Models\Recipe','recipe_tags');
    }
}
