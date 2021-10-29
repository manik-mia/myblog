@extends('layouts.admin')
@section('title','All Articles')
@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-10">
                <h3>All Articles</h3>
            </div>
            <div class="col-2 text-right">
                <a href="{{route('articles.create')}}" class="btn btn-primary">Add New</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="data-table" class="table table-striped table-sm table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>SI</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Feature Image</th>
                            <th>Approve Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $start = 0;
                        @endphp
                        @forelse ($articles as $article)
                        <tr>
                            <td>{{++$start}}</td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->user->name}}</</td>
                            <td> <img src="{{Storage::exists($article?->image?->url) ? Storage::url($article->image->url) : 'https://picsum.photos/100/100'}}" alt="{{$article->title}}" class="img-thumbnail"></</td>
                            {{-- <td><img src="{{ Storage::exists($article?->_feature_image) ? Storage::url($article->_feature_image) : 'https://picsum.photos/100/100' }}" class="img-thumbnail" alt="{{ $article->title }}"></td> --}}
                            <td>{{$article->status}}</</td>
                            <td>{{$article->created_at}}</</td>
                            <td>{{$article->updated_at->diffForHumans()}}</</td>
                            <td class="action">
                                <a href="{{route('articles.show',[$article->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{route('articles.edit',[$article->id])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{route('articles.destroy',[$article->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" id="delete_btn" onclick="return deleteConfirm();"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        
                        @empty
                            <tr>
                                <td colspan="6">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        let articleTitle= '{{$article->title}}';
        let deleteArticle=document.getElementById('delete_btn');
        deleteArticle.addEventListener('click',deleteConfirm);
        function deleteConfirm(){
            Swal.fire({
                icon: 'warning',
                title: `Do You Want to delete this"${articleTitle}"`
            });
              
        }
        @if (Session::has('success'))
            let success='{{ session('success') }}';
            
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: success
            });
        @endif
    </script>
@endsection
