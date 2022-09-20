<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Blog;
use App\Providers\RouteServiceProvider;
use App\Services\Blog\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        /** @var BlogService $blogService */
        $blogService = resolve(BlogService::class);

        $blogs = $blogService->all();

        return view('blogs.index',[
            'blogs' => $blogs
        ]);
    }

    public function show(Blog $blog)
    {
        return view('blogs.show',[
            'blog' => $blog
        ]);
    }
}
