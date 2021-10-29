@extends('layouts.admin')
@section('title' ,'Add New Article')
@section('content')
    <div class="container pt-5 article-container">
        <div class="row">
            <div class="col-10">
                <h4>Add New Article</h4>
            </div>
            <div class="col-2">
                <a href="{{route('articles.index')}}" class="btn btn-sm btn-primary">See All</a>
            </div>
        </div>
        <form action="{{route('articles.store')}}" enctype="multipart/form-data" method="POST" class="article-form">
            @include('article.form',['action'=>'Save'])
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        @if (Session::has('error'))
            let error='{{ session('error') }}';
            Swal.fire({
                icon: 'error',
                title: 'Fail',
                text: error
                })
        @endif
    </script>
@endsection
