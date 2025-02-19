<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;

class NewsController extends Controller
{
    public function index()
    {
        $destinations = Post::with('categories')
            ->whereHas('categories', function ($query) {
                $query->where('categories.id', Category::DESTINATION);
            })
            ->where('status', Post::STATUS_ACTIVE)
            ->orderBy('posts.id', 'desc')
            ->limit(30)
            ->get();
        $listNews = Post::where('status', Post::STATUS_ACTIVE)
            ->whereHas('categories', function ($query) {
                $query->where('categories.id', Category::CATNEW);
            })
            ->orderBy('posts.position', 'asc')
            ->orderBy('posts.updated_at', 'desc')
            ->paginate(6);
        $tips = Post::with('categories')
            ->whereHas('categories', function ($query) {
                $query->where('categories.id', Category::TIPS);
            })
            ->where('status', Post::STATUS_ACTIVE)
            ->orderBy('posts.position', 'asc')
            ->orderBy('posts.updated_at', 'desc')
            ->limit(100)
            ->get();
        $page = Page::where('type', Page::NEWS_PAGE)->first();
        return view('frontend.news',[
            'destinations' => $destinations,
            'listNews' => $listNews,
            'tips' => $tips,
            'page' => $page->content
        ]);
    }

    public function detail($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $tips = Post::with('categories')
            ->whereHas('categories', function ($query) use ($post) {
                $query->where('categories.id', $post->categories[0]->id);
            })
            ->where('status', Post::STATUS_ACTIVE)
            ->orderBy('posts.position', 'asc')
            ->orderBy('posts.updated_at', 'desc')
            ->limit(5)
            ->get();
        return view('frontend.news_detail', [
            'post' => $post,
            'tips' => $tips,
        ]);
    }

}
