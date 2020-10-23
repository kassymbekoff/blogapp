<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\General;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke($slug){
        $website = General::query()->firstOrFail();

        $category = Category::query()->where('slug', $slug)->firstOrFail();

        $posts = $category->posts()->where('is_published', true)->orderBy('id', 'desc')->get();

        $categories  = Category::all();

        $tags = Tag::all();

        $recentPosts = Post::query()
                        ->where('is_published', true)
                        ->orderBy('id', 'desc')
                        ->take(5)
                        ->get();

        return view('category', [
            'website' => $website,
            'category' => $category,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'recentPosts' => $recentPosts
        ]);
    }
}
