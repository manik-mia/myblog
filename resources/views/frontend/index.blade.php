@extends('layouts.web')
@section('title','Stand CSS Blog by TemplateMo')
@section('content')

      <div class="col-lg-8">
          <div class="all-blog-posts">
            <div class="row">
              
              @forelse ($articles as $article)
              <div class="col-lg-12">      
                <div class="blog-post">
                  <div class="blog-thumb">
                    <img src="{{Storage::exists($article?->image?->url) ? Storage::url($article->image->url) : 'https://picsum.photos/100/100'}}" alt="">
                  </div>
                  <div class="down-content">
                    <span>Lifestyle</span>
                    <a href="post-details.html"><h4>{{$article->title}}</h4></a>
                    <ul class="post-info">
                      <li><a href="#">{{$article->user->name}}</a></li>
                      <li><a href="#">{{$article->updated_at->diffForHumans()}}</a></li>
                    </ul>
                    {!!$article->description!!}
                    <div class="post-options">
                      <div class="row">
                        <div class="col-6">
                          <ul class="post-tags">
                            <li><i class="fa fa-tags"></i></li>
                            <li><a href="#">Beauty</a>,</li>
                            <li><a href="#">Nature</a></li>
                          </ul>
                        </div>
                        <div class="col-6">
                          <ul class="post-share">
                            <li><i class="fa fa-share-alt"></i></li>
                            <li><a href="#">Facebook</a>,</li>
                            <li><a href="#"> Twitter</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                
              @empty
                 <p>No data found</p> 
              @endforelse
              
              <nav aria-label="Page navigation">
                {{ $articles->links() }}
              </nav>
            </div>
          </div>
        </div>
          @include('frontend.sidebar')

@endsection
