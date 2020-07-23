<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Post;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        session()->put('recordsTotal', Post::all()->count());
//        $posts = Post::all();

//        return view('home', ['posts' => $posts]);
        return view('home');
    }

}
