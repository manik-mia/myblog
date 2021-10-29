<?php

namespace App\Http\Controllers;

use App\Models\Category;
// use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\CategoryRequest as Request;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::withCount('articles')->latest()->get();
        return view('category.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.add-category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        try {
            Category::create($request->all());

            return redirect()->route('Categories.index')->withSuccess(
                __('common.created', ['title' => $request->name])
            );
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withError(
                $e->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('tags.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $category->update($request->all());

            return redirect()->route('categories.index')->withSuccess(
                __('common.updated', ['title' => $category->name])
            );
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withError(
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $name = $category->name;

            $category->delete();
            return redirect()->back()->withSuccess(__('common.created', ['title' => $name]));
        } catch (\Exception $exception) {
            return redirect()->back()->withError(
                $exception->getMessage()
            );
        }
    }
}
