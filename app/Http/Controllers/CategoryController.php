<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
// use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(? string $category = null){
        $posts= isset($category) ? Category::where('name',$category)->first()->posts : Post::all();
        $categories = Category::all();
        return view('home',compact('posts','categories'));
    }
}
