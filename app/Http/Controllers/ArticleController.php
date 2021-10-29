<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest as Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Tag;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::with(['user','image'])->latest()->get();
        return view('article.articles',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.add-article');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName=Str::slug($request->image_name,'-');
        try {
            $imagePath = null;
            if ($request->hasFile('feature_image')) {
                $fileName = $imageName . '.' . $request->feature_image->extension();
                $imagePath = $request->feature_image->storeAs('/public/images/articles', $fileName);
            }
            $article=auth()->user()->articles()->create($request->all());
            
            $article->image()->create([
                'name'=>$request->image_name,
                'url'=>$imagePath
            ]);
            return redirect()->route('articles.index')->withSuccess(
                __('common.created',['title'=>$request->title])
            );
        } catch (\Exception  $e) {
            return redirect()->back()->withInput()->withError(
                $e->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->load('image');
        return view('article.single-article',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $tags = Tag::pluck('name', 'id');

        $tag_ids = $article->tags()->pluck('id')->toArray();
        return view('article.edit',compact('article','tags','tag_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $imageName=Str::slug($request->image_name,'-');
        try {
            $imagePath = $article->feature_image;
            if ($request->hasFile('feature_image')) {
                if($article->feature_image && Storage::exists($article->feature_image)){
                    Storage::delete($article->feature_image);
                }
                $fileName = $imageName . '.' . $request->feature_image->extension();
                $imagePath = $request->feature_image->storeAs('/public/images/articles', $fileName);
            }
            $article->update($request->all());
            $article->image()->create([
                'name'=>$request->image_name,
                'url'=>$imagePath
            ]);
            return redirect()->route('articles.index')->withSuccess(
                __('common.updated',['title'=>$request->title])
            );
        } catch (\Exception  $e) {
            return redirect()->back()->withInput()->withError(
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {
            $title=$article->title;
            $article->delete();
            return redirect()->back()->withSuccess(__('common.deleted',['title'=>$title]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(
                $e->getMessage()
            );
        }
    }
    public function trashed()
    {
        $articles=Article::with('user')->onlyTrashed()->latest()->get();
        return view('article.trashed',compact('articles'));
    }
    public function restore(\Illuminate\Http\Request $request,$articleId)
    {
        $article=Article::withTrashed()->findOrFail($articleId);
        try {
            $article->restore();
            return redirect()->back()->withSuccess(
                __('common.restored',['Title'=>$article->title])
            );
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(
                $e->getMessage()
            );
        }
    }
    public function erase($articleId)
    {
        $article = Article::withTrashed()->findOrFail($articleId);
        try {
            $title=$article->title;
            if($article->feature_image && Storage::exists($article->feature_image)){
                Storage::delete($article->feature_image);
            }
            $article->delete();
            return redirect()->back()->withSuccess(__('common.erase',['title'=>$title]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(
                $e->getMessage()
            );
        }
    }
    // public function upload(Request $request){
    //     $fileName=$request->file('file')->getClientOriginalName();
    //     $path=$request->file('file')->storeAs('uploads', $fileName, 'public');
    //     return response()->json(['location'=>"/storage/$path"]);

    //     $imgpath = request()->file('name')->store('uploads', 'public');
    //     return response()->json(['location' => '/' . $imgpath]);

    // }
}
