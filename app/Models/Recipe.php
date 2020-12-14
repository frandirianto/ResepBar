<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function recipeTags(){
        return $this->belongsToMany('App\Models\Tag','recipe_tags','recipe_id','tag_id');
    }

    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }

    public function saveRecipe(){
        return $this->belongsToMany('App\Models\SaveRecipe');
    }
}
