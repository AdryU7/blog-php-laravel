<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Show categories on admin
        $categories = Category::orderBy('id', 'desc')
                                ->simplePaginate(8);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->all();

        //Validate if there is a file
        if ($request->hasFile('image')) {
            $category['image'] = $request->file('image')->store('categories');
        }

        //Save info
        Category::create($category);

        return redirect()->action([CategoryController::class, 'index'])
                         ->with('success-create', 'Categoría creada con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // If user uploads an image
        if ($request->hasFile('image')){
            //Delete previous image
            File::delete(public_path('storage/' . $category->image));
            //Asign a new image
            $category['image'] = $request->file('image')->store('categories');
        }

        // Update data
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'is_featured' => $request->is_featured
        ]);

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                         ->with('success-update', 'Categoría modificada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete image from category
        if ($category->image) {
            File::delete(public_path('storage/') . $category->image);
        }

        $category->delete();

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                         ->with('success-delete', 'Categoría eliminada con éxito');
    }

    // Filter articles by categories
    public function detail(Category $category) {
        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1']
        ])->orderBy('id', 'desc')
          ->simplePaginate(5);
        
        $navbar = Category::where([
            ['status', '3'],
            ['is_featured', '1']
        ])->paginate(3);

        return view('subscriber.categories.detail', compact('articles', 'category', 'navbar'));
    }
}
