@extends('layouts.admin')
@section('title','All Categories')
@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-10">
                <h3>All Category</h3>
            </div>
            <div class="col-2 text-right">
                <a href="{{route('categories.create')}}" class="btn btn-primary btn-sm">Add New</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="data-table" class="table table-striped table-sm table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>SI</th>
                            <th>Title</th>
                            <th>Article</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $start = 0;
                        @endphp
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{++$start}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->article_count()}}</</td>
                            <td>{{$category->created_at}}</</td>
                            <td>{{$category->updated_at->diffForHumans()}}</</td>
                            <td class="action">
                                <a href="{{route('categories.create',[$category->id])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{route('categories.destroy',[$category->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" id="delete_btn" onclick="return return onfirm('Do you want to delete this Category');"><i class="fas fa-trash-alt"></i></button>
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
