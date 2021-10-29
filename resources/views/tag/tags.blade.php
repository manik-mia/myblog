@extends('layouts.admin')
@section('title','All Articles')
@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-10">
                <h3>All Tags</h3>
            </div>
            <div class="col-2 text-right">
                <a href="{{route('tags.create')}}" class="btn btn-primary">Add New</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="data-table" class="table table-striped table-sm table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>SI</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $start = 0;
                        @endphp
                        @forelse ($tags as $tag)
                        <tr>
                            <td>{{++$start}}</td>
                            <td>{{$tag->name}}</</td>
                            <td>{{$tag->created_at}}</</td>
                            <td>{{$tag->updated_at->diffForHumans()}}</</td>
                            <td class="action">
                                <a href="{{route('articles.edit',[$tag->id])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
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
        let articleTitle= 'name';
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
