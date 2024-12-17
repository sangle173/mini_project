@extends('manager.manager_dashboard')
@section('users')

@section('title')
    Blog
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet"/>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Blog Post</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Blog Post</h5>
            <form id="myForm" action="{{ route('update.blog.post') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $post->id }}">

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Blog Category </label>
                    <select name="blogcat_id" class="form-select mb-3" aria-label="Default select example">
                        <option selected="">Open this select menu</option>
                        @foreach ($blogcat as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $post->blogcat_id ? 'selected' : '' }} >{{ $cat->category_name }}</option>
                        @endforeach
                        @error('blogcat_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Post Title</label>
                    <input type="text" name="post_title" class="form-control" id="input1" value="{{ $post->post_title }}" >
                    @error('post_title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="input1" class="form-label">Post Description</label>
                    <textarea name="long_descp" class="form-control">{!! $post->long_descp !!}</textarea>
                    @error('long_descp')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Post Tags</label>
                    <input type="text" name="post_tags" class="form-control" data-role="tagsinput" value="{{ $post->post_tags }}">
                    @error('post_tags')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Post Image </label>
                    <input class="form-control" name="post_image" type="file" id="image">
                    @error('post_image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <img id="showImage" src="{{ asset($post->post_image) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">

                </div>



                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
          <button type="submit" class="btn btn-primary px-4">Save Changes</button>

                    </div>
                </div>
            </form>
        </div>
    </div>




</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    const quill = new Quill('#editor', {
        theme: 'snow'
    });

</script>
<script>
    // Initialize Quill
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    // Set the existing content (HTML) into the editor
    var existingContent = `{!! addslashes($post->long_descp) !!}`; // Pass content safely
    quill.root.innerHTML = existingContent;

    // Populate the hidden input before submitting the form
    document.getElementById('myForm').onsubmit = function() {
        var content = quill.root.innerHTML; // Get editor content
        document.getElementById('long_descp').value = content;
    };
</script>
<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>


@endsection
