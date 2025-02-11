@extends('manager.manager_dashboard')
@section('users')

@section('title')
    Blog
@endsection
<!--tagsinput-->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet"/>

<link href="{{ asset('backend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet"/>
<!--tagsinput-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Blog</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Blog Post</h5>
            <form id="myForm" action="{{ route('store.blog.post') }}" method="post" class="row g-3"
                  enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Blog Category </label>
                    <select name="blogcat_id" class="form-select mb-3" aria-label="Default select example">
                        <option selected="">Select Category</option>
                        @foreach ($blogcat as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    @error('blogcat_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Post Title</label>
                    <input type="text" name="post_title" class="form-control" id="input1">
                    @error('post_title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <input type="hidden" id="long_descp" name="long_descp" class="form-control">

                <div id="editor" style="height: 400px">
                    <p>Description</p>
                    <p><br/></p>
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Post Tags</label>
                    <input type="text" name="post_tags" class="form-control" data-role="tagsinput" value="Demo">
                    @error('post_tags')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Post Document </label>
                    <input class="form-control" name="post_image" type="file" id="image">
                    @error('post_image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <img id="showImage" src="{{ url('upload/no_image.jpg')}}" alt="Admin"
                         class="rounded-circle p-1 bg-primary" width="80">
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

<script type="text/javascript">

    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

<script>
    document.getElementById('myForm').onsubmit = function () {
        // Get the Quill editor's HTML content
        var content = quill.root.innerHTML;
        console.log("=====================")
        console.log(content)
        console.log("=====================")

        // Assign content to the hidden input
        document.getElementById('long_descp').value = content;
    };
</script>


@endsection
