
@csrf
<div class="row article-row">
    <div class="col-9 main-content">
        <div class="form-group my-3">
            <label for="title">Article Title</label>
            <input type="text" value="{{old("name",$article->title ?? "")}}" name="title" id="title" class="form-control @error('name') is-invalid @enderror">
        </div>
        <div class="form-group my-3 text-end">
            <input type="submit" value="{{$action}}" class="btn btn-primary">
        </div>
    </div>
    <div class="col-3 p-0 pt-4 right-sidebar">
    </div>
</div>