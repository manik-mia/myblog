@extends('layouts.admin')
@section('title','All Articles')
@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-10">
                <h3>Deleted Articles</h3>
            </div>
            <div class="col-2 text-right">
                <a href="{{route('articles.create')}}" class="btn btn-primary">All Articles</a>
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
                            <th>Created At</th>
                            <th>Deleted At</th>
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
                            <td>{{$article->created_at}}</</td>
                            <td>{{$article->deleted_at->diffForHumans()}}</</td>
                            <td class="action">
                                <form method="post" action="{{ route('articles.restore', [$article->id]) }}">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-primary btn-sm">Restore</button>
                                </form>
                                <form method="post" action="{{ route('articles.erase', [$article->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete &quot;{{ $article->title }}&quot;?');">Delete</button>
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
