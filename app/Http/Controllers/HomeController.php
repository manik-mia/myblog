<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class HomeController extends Controller
{
    public function index()
    {
        $articles=Article::with(['user','image'])->active()->latest()->paginate(5);
        // dd($articles);
        return view('frontend.index',compact('articles'));
    }
}
