<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
//use Illuminate\Http\Request;

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
        // Obtain public articles with public (1) status,
        // order by desc by id
        // and show only 10 on the main page
        $articles = Article::where('status', '1')
                    ->orderBy('id', 'desc')
                    ->simplePaginate(10);

        // Obtain categories with public (1) status and
        // featured (1)
        $navbar = Category::where([
            ['status','1'],
            ['is_featured', '1']
        ])->paginate(3);

        // Show both elements in the view
        return view('home.index', compact('articles', 'navbar'));
    }

    // Show all categories
    public function all() {
        $categories = Category::where('status', '1')
            ->simplePaginate(20);
        
        $navbar = Category::where([
            ['status','1'],
            ['is_featured', '1']
        ])->paginate(3);

        return view('home', compact('categories', 'navbar'));
    }
}
