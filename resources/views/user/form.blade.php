
@csrf
<div class="row article-row">
    <div class="col-9 main-content">
        <div class="form-group my-3">
            <label for="title">Article Title</label>
            <input type="text" value="{{old("title",$article->title ?? "")}}" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
        </div>
        <div class="form-group my-3">
            <label for="slug">Article Slug</label>
            <input type="text" name="slug" id="slug" value="{{old("slug",$article->slug ?? "")}}" class="form-control">
        </div>
        {{request()->segment(2)}}
        <div class="form-group my-3">
            <div class="form-outline mb-2">
                <input type="text" id="image_name" class="form-control" name="image_name"/>
                <label class="form-label" for="image_name">Image Name</label>
              </div>
            <div class="feature-image">
                <input type="file" name="feature_image" id="feature-image" accept="image/*" class="feature-image" >
                <div class="image-preview" id="image-preview">
                    <img src="" alt="Feature Image" id="preview-image" class="preview-image">
                    @if ($article)
                        @if(Storage::exists($article?->image?->url))
                            <div style="width: 50%;height:auto">
                                <img src="{{ Storage::url($article->image->url) }}" class="img-fluid img-thumbnail" alt="">
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group my-3">
            <label for="status">Approval Status</label>
            <select class="form-select" value="{{old("status",$article->status ?? "")}}" id="status" name="status">
                <option value="Approve">Approve</option>
                <option value="Pending" selected>Pending</option>
                <option value="Reject">Reject</option>
            </select>
        </div>
        <div class="form-group my-3">
            <label for="description">Article Description</label>
            <textarea name="description" id="description" class="form-control description @error('description') is-invalid @enderror">
                {{old("description",$article->description ?? "")}}
            </textarea>
        </div>
        
        <div class="form-group my-3 text-end">
            <input type="submit" value="{{$action}}" class="btn btn-primary">
        </div>
    </div>
    <div class="col-3 p-0 pt-4 right-sidebar">
        {{-- <div class="accordion">
            <div class="accordion-title">
                <h6 class="mb-0">Feature Image</h6>
                <i class="fas fa-chevron-down accordion-icon"></i>
            </div>
            <div class="accordion-content">
                <div class="form-outline mt-1">
                    <input type="text" id="image_name" class="form-control form-control-sm" name="image_name"/>
                    <label class="form-label" for="image_name">Name</label>
                  </div>
                <div class="feature-image">
                    <input type="file" name="feature_image" value="{{old("feature_image")}}" id="feature-image" class="feature-image" >
                    <div class="image-preview" id="image-preview">
                        <img src="" alt="Feature Image" id="preview-image" class="preview-image">
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="accordion">
            <div class="accordion-title">
                <h6 class="mb-0">Categories</h6>
                <i class="fas fa-chevron-down accordion-icon"></i>
            </div>
            <div class="accordion-content">
                <div class="tag">
                    <select class="select" multiple data-mdb-filter="true">
                        @foreach($tags as $tag_id => $tag)
                            <option value="{{ $tag_id }}"{{ in_array($tag_id, old('tag_id', $tag_ids ?? [])) ? ' selected' : '' }}>{{ $tag }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="accordion">
            <div class="accordion-title">
                <h6 class="mb-0">Tags</h6>
                <i class="fas fa-chevron-down accordion-icon"></i>
            </div>
            <div class="accordion-content">
                <div class="cate">
                    <select class="select" multiple data-mdb-filter="true">
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                        <option value="5">Five</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>