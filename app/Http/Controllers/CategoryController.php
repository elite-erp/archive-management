<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $search = request('search', '');
       $categories = Category::query()->when($search, function ($query, $search) {
            $query->where('label', 'like', "%{$search}%");
        })->select(['label', 'id'])->withCount('documents')->with('documents', function ($query) {
            $query->with('category')->latest()->limit(5);
        })->latest()->paginate(5)->withQueryString();

        return Inertia::render('categories/index', compact(
            'categories',
            'search',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->only('label'));

        return to_route('categories.index')->with('message', 'تم الحفظ بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $documents = $category->documents()->with('category', 'attachments')->latest()->paginate(10);

        return Inertia::render('categories/show', compact('category', 'documents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category)
    {
        $data = request()->validate([
            'label' => 'required|min:3|unique:categories,label,' . $category->id
        ]);
        $category->update($data);

        return to_route('categories.show', $category->id)->with('message', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return [
            'status' => 'OK',
            'message' => 'Category Deleted Successfully'
        ];
    }
}
