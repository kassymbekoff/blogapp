<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\General;
use App\Models\Post;
use App\Models\Tag;

class IndexController extends Controller
{
    public function __invoke(){
        $website = General::query()->firstOrFail();

        $posts = Post::query()
                    ->where('is_published', true)
                    ->orderBy('id', 'desc')
                    ->paginate();

        $featuredPosts = Post::query()
                    ->where('is_published', true)
                    ->where('is_featured', true)
                    ->orderBy('id', 'desc')
                    ->take(5)
                    ->get();

        $categories = Category::all();
        $tags       = Tag::all();
        $recentPosts = Post::query()
                    ->where('is_published', true)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
        return view('homepage', [
            'website' => $website,
            'featuredPosts' => $featuredPosts,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'recentPosts' => $recentPosts
        ]);
    }
}
