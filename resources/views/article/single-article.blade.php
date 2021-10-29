@extends('layouts.admin')
@section('title',$article->title )
@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-10">
                <h3>Article Preview</h3>
            </div>
            <div class="col-2 text-right">
                <a href="{{route('articles.index')}}" class="btn btn-primary">See All</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $article->title }}</h2>
                    <p class="blog-post-meta">{{ $article->created_at->format('F j, Y') }} by <a href="#">{{ $article->user->name }}</a></p>
                    <div style="width: 80%;">
                        @if(Storage::exists($article?->image?->url))
                            <picture>
                                <img class="img-fluid"style="width: 50%;height:auto;" src="{{ Storage::url($article->image->url) }}" alt="{{ $article->title }}">
                            </picture>
                        @endif
                    </div>
                    <p>{!! $article->description !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

