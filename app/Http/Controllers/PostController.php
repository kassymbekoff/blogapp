<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\General;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function show($slug){
        $website = General::query()->firstOrFail();

        $post = Post::query()
                    ->where('is_published', true)
                    ->where('slug', $slug)
                    ->firstOrFail();

        $categories = Category::all();
        $tags = Tag::all();

        $recentPosts = Post::query()
                    ->where('is_published', true)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

        return view('post', [
            'website' => $website,
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'recentPosts' => $recentPosts
        ]);
    }
}
