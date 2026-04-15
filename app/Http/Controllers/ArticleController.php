<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    // CREATED BY USING THIS COMMAND
    // > php artisan make:controller ArticleController --model=Article
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ** Show articles on admin **
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->simplePaginate(10);
        
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ** Obtain public categories **
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get();

        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        /** FORM:
         * 1. Title = "Article 1"
         * 2. Slug = "article-1"
         * 3. Introduction = "This is the first article"
         * 4. Image = "photo.png"
         * 5. Body = "First article of the course"
         * 6. Status = 3
         * 8. Category_ID = 1
         */

        // ** Obtain data in a massive way **
        $request->merge([
            'user_id' => Auth::user()->id,
        ]);

        // ** Saving request in a variable **
        $article = $request->all();

        // ** Validate if there is a file in the request **
        if ($request->hasFile('image')) {
            $article['image'] = $request->file('image')->store('articles');
        }

        Article::create($article);

        return redirect()->action([ArticleController::class, 'index'])
                         ->with('success-create', 'Articulo creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $comments = $article->comments()->simplePaginate(5);

        return view('subscriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // ** Obtain public categories **
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get();

        return view('admin.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        // If user uploads a new image
        if($request->hasFile('image')) {
            // Delete previous image
            File::delete(public_path('storage/' . $article->image));
            // Asign new image
            $article['image'] = $request->file('image')->store('articles');
        }

        //Update data
        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'status' => $request->status
        ]);

        return redirect()->action([ArticleController::class, 'index'])
                         ->with('success-update', 'Articulo modificado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Delete image from article
        if ($article->image) {
            File::delete(public_path('storage/' . $article->image));
        }

        // Delete article
        $article->delete();

        return redirect()->action([ArticleController::class, 'index'])
                         ->with('success-delete', 'Articulo eliminado con éxito.');
    }
}
