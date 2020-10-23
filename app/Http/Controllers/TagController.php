<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\General;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke($slug){
        $website = General::query()->firstOrFail();
        $tag = Tag::query()->where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->where('is_published', true)->orderBy('id', 'desc')->get();
        $categories = Category::all();
        $tags = Tag::all();
        $recentPosts = Post::query()
                        ->where('is_published', true)
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
        return view('tag', [
            'website' => $website,
            'tag' => $tag,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'recentPosts' => $recentPosts
        ]);
    }
}
