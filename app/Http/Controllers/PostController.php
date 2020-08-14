<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Post;
use App\QueryFilters\Posts\Active;
use App\QueryFilters\Posts\Sort;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Option 1. Hardcode way.
//        $postQuery = Post::query();
//
//        if ($request->has('active'))
//        {
//            $postQuery->where('active', boolval($request->get('active')));
//        }
//
//        if ($request->has('sort'))
//        {
//            $postQuery->orderBy('title', $request->get('sort'));
//        }
//
//        $posts = $postQuery->get();
//
//        return view('post.index', compact('posts'));

        // Option 2. Pipeline.
//        $posts = app(Pipeline::class)
//            ->send(Post::query())
//            ->through([
//                Active::class,
//                Sort::class,
//            ])
//            ->thenReturn()
//            ->get();
//
//        return view('post.index', compact('posts'));

        // Option 3. Pipeline refactored: realization moved to Post model.
        $posts = Post::getPosts();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }
}
