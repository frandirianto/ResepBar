<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Http\Resources\RecipeResource;

class RecipeController extends Controller
{
   public function getAll(){
        $recipe = Recipe::with(['user','category','recipeTags','reviews'])->get();
        $recipe = RecipeResource::collection($recipe);
        
        return response()->json([
            'recipe' => $recipe
        ], 201);
   }
}
