<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required', 
            'image' => 'required|mimes:jpeg,png,bmp,tiff',
            'category_id' => 'required|numeric'
        ]);

        $category = ArticleCategory::find($request->category_id);
        if(!$category){
            return response()->json([
                'message' => 'category not found',
                'status' => 'fail'
            ], 404);
        }

        $article = new Article();

        $image = $request->file('image');
        $imageName = Str::slug($request->title, '-') . '_' . time() . '.' . $image->getClientOriginalExtension();
        $image->move('images/article/', $imageName);

        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $imageName;
        $article->category_id = $request->category_id;
        $article->user_id = Auth::user()->id;

        $article->save();

        return response()->json([
            'message' => 'article created',
            'status' => 'success',
        ], 201);
    }

    public function getAll(){
        $article = Article::with('user', 'category')->paginate(5);

        return response()->json($article);
    }

    public function getById($id){
        $article = Article::with('user', 'category')->where('id', $id)->first();

        if($article){
            return response()->json([
                'message' => 'article successfully taken',
                'status' => 'success',
                'data' => $article,
            ], 200);
        }

        return response()->json([
            'message' => 'wrong article id',
            'status' => 'fail'
        ], 404);
    }

    public function update($id, Request $request){
        $article = Article::find($id);
        
        if($article){
            if($request->category_id){
                $category = ArticleCategory::find($request->category_id);
                if(!$category){
                    return response()->json([
                        'message' => 'category not found',
                        'status' => 'fail'
                    ], 404);
                }

                $article->category_id = $category->id;
            }

            if($request->hasFile('image')){
                $request->validate([
                    'image' => 'mimes:jpeg,png,bmp,tiff',
                ]);

                $image = $request->file('image');
                $imageName = ($request->title ? Str::slug($request->title, '-') : Str::slug($article->title, '-')) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move('images/article', $imageName);

                $article->image = $imageName;
            }

            $article->title = $request->title ? $request->title : $article->title;
            $article->content = $request->content ? $request->content : $article->content;

            $article->save();

            return response()->json([
                'message' => 'article successfully updated',
                'status' => 'success',
            ]);
        }

        return response()->json([
            'message' => 'wrong article id',
            'status' => 'fail',
        ], 404);
    }

    public function delete($id){
        $article = Article::find($id);

        if($article){
            $article->delete();

            return response()->json([
                'message' => 'article successfully deleted',
                'status' => 'success',
            ]);
        }

        return response()->json([
            'message' => 'wrong article id',
            'status' => 'fail',
        ], 404);
    }
}
