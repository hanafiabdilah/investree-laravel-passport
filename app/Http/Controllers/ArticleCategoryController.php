<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleCategoryController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $category = new ArticleCategory();

        $category->name = $request->name;
        $category->user_id = Auth::user()->id;

        $category->save();

        return response()->json([
            'message' => 'article category created',
            'status' => 'success',
        ], 201);
    }
}
