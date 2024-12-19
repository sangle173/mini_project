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
                    <li class="breadcrumb-item active" aria-current="page">Edit Note</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Note</h5>
            <form id="myForm" action="{{ route('update.note') }}" method="post" class="row g-3"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$note -> id}}" name="id">
                <div class="form-group col-md-12">
                    <label for="input1" class="form-label">Title</label>
                    <input type="text" value="{{$note -> title}}" name="title" class="form-control" id="input1">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" id="long_descp" name="content" class="form-control">

                <div id="editor" style="height: 400px">
                    {!! $note -> content !!}
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
