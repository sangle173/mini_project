@extends('manager.manager_dashboard')
@section('users')

@section('title')
    Upload Files
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class=" d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Upload File</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$user ->name}}'s file</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <button type="button" class="btn btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i
                                class='bx bx-link-external mr-1'></i>QR Code
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <{!! $simple !!}</a>
                                        <p>{{$result}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form id="myForm" action="{{ route('user.uploadfile.post') }}" method="post" class="row g-3"
                          enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" class="form-input" name="user_id" value="{{ $user->id }}">

                        <div class="input-group mb-3">
                            <input type="file" name="files[]" onchange="GetFileSizeNameAndType()" multiple
                                   class="form-control" id="inputGroupFile02">
                            <button class="btn btn-primary" for="inputGroupFile02"><i class="bx bx-upload"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class=" d-none d-sm-flex align-items-center mb-3">
                <form id="myForm" action="{{ route('upload.files.user') }}" method="get" class="row"
                      style="margin-bottom: 10px">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="input-group" style="width: 300px">
                        <select class="form-select" name="user_id" id="inputGroupSelect04"
                                aria-label="Example select with button addon">
                            @foreach ($users as $u)
                                <option
                                    {{ $user->id === $u->id? 'selected':'' }} value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success" type="submit">Change</button>
                    </div>
                </form>
                <div class="ms-auto">
                    <button type="button" class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteAll">Delete All
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Files</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Do you want to delete all of files?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <a title="Delete All" href="{{ route('delete.fileall',$user->id) }}"
                                       type="button" class="btn btn-danger">Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="1.5%">#</th>
                        <th>File</th>
                        <th width="5%">Download</th>
                        <th style="width: 10%!important;">Uploaded by</th>
                        <th style="width: 10%!important;">Uploaded at</th>
                        <th style="width: 5%!important;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        if ( !function_exists( 'formatBytes' ) ) {
                           function formatBytes($size, $precision = 2)
                        {
                            if ($size > 0) {
                                $size = (int) $size;
                                $base = log($size) / log(1024);
                                $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

                                return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
                            } else {
                                return $size;
                            }
                        }
                        }
                    @endphp
                    @foreach ($files as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <div class="d-flex align-items-center mt-3">

                                    @switch($item-> extension)
                                        @case('png')
                                        <div class="fm-file-box bg-light-success text-success">
                                            <i class='bx bxs-image'></i>
                                        </div>
                                        @break
                                        @case('PNG')
                                        <div class="fm-file-box bg-light-success text-success">
                                            <i class='bx bxs-image'></i>
                                        </div>
                                        @break
                                        @case('jpeg')
                                        <div class="fm-file-box bg-light-success text-success">
                                            <i class='bx bxs-image'></i>
                                        </div>
                                        @break
                                        @case('JPEG')
                                        <div class="fm-file-box bg-light-success text-success">
                                            <i class='bx bxs-image'></i>
                                        </div>
                                        @break

                                        @case('jpg')
                                        <div class="fm-file-box bg-light-success text-success">
                                            <i class='bx bxs-image'></i>
                                        </div>
                                        @break

                                        @case('JPG')
                                        <div class="fm-file-box bg-light-success text-success">
                                            <i class='bx bxs-image'></i>
                                        </div>
                                        @break

                                        @case('mp4')
                                        <div class="fm-file-box bg-light-danger text-danger">
                                            <i class='bx bxs-video'></i>
                                        </div>
                                        @break
                                        @case('MP4')
                                        <div class="fm-file-box bg-light-success text-success">
                                            <i class='bx bxs-video'></i>
                                        </div>
                                        @break
                                        @case('mov')
                                        <div class="fm-file-box bg-light-danger text-danger">
                                            <i class='bx bxs-video'></i>
                                        </div>
                                        @break
                                        @case('MOV')
                                        <div class="fm-file-box bg-light-danger text-danger">
                                            <i class='bx bxl-android text-primary'></i>
                                        </div>
                                        @break

                                        @case('apk')
                                        <div class="fm-file-box bg-light-primary text-primary">
                                            <i class='bx bxl-android text-primary'></i>
                                        </div>
                                        @break

                                        @case('APK')
                                        <div class="fm-file-box bg-light-primary text-primary">
                                            <i class='bx bxs-android text-danger'></i>
                                        </div>
                                        @break

                                        @case('ipa')
                                        <div class="fm-file-box bg-light-info text-info">
                                            {{--                                                        <i class='bx bxs-building text-warning'></i>--}}
                                            <i class="lni lni-apple"></i>
                                        </div>
                                        @break

                                        @case('IPA')
                                        <div class="fm-file-box bg-light-info text-info">
                                            {{--                                                        <i class='bx bxs-building text-warning'></i>--}}
                                            <i class="lni lni-apple"></i>
                                        </div>
                                        @break

                                        @case('pdf')
                                        <div class="fm-file-box bg-light-danger text-danger">
                                            <i class='bx bxs-file-pdf'></i>
                                        </div>
                                        @break
                                        @case('PDF')
                                        <div class="fm-file-box bg-light-danger text-danger">
                                            <i class='bx bxs-file-pdf'></i>
                                        </div>
                                        @break

                                        @case('doc')
                                        <div class="fm-file-box bg-light-primary text-danger">
                                            <i class='bx bxs-file-doc'></i>
                                        </div>
                                        @break
                                        @case('DOC')
                                        <div class="fm-file-box bg-light-primary text-primary">
                                            <i class='bx bxs-file-doc'></i>
                                        </div>
                                        @break

                                        @case('xlsx')
                                        <div class="fm-file-box bg-light-info text-info">
                                            <i class='bx bxs-spreadsheet'></i>
                                        </div>
                                        @break
                                        @case('xlsx')
                                        <div class="fm-file-box bg-light-info text-info">
                                            <i class='bx bxs-spreadsheet'></i>
                                        </div>
                                        @break

                                        @default
                                        <div class="fm-file-box bg-light-secondary text-secondary">
                                            <i class='bx bxs-file'></i>
                                        </div>
                                    @endswitch


                                    <div class="flex-grow-1 ms-2 ml-3">
                                        <h6 class="mb-0">

                                        @if($item-> extension == 'mp4' ||  $item-> extension == 'mov')
                                            <!-- Button trigger modal -->
                                                <a class="text-decoration-none" data-bs-toggle="modal"
                                                   data-bs-target="#exampleLargeModal{{$item-> id}}">{{substr($item-> name,11)}}</a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleLargeModal{{$item-> id}}"
                                                     tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Video Preview</h5>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <video width="760" height="480" controls Autoplay=autoplay>
                                                                    <source src="{{  asset('uploads/'.$item-> name) }}"
                                                                            type="video/mp4">
                                                                    <source src="{{  asset('uploads/'.$item-> name) }}"
                                                                            type="video/ogg">
                                                                    <source src="{{  asset('uploads/'.$item-> name) }}"
                                                                            type="video/mov">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <a href="{{  asset('uploads/'.$item-> name) }}" target="blank"
                                                   title="Review Files">{{substr($item-> name,11)}}</a>
                                            @endif
                                        </h6>
                                        <p class="mb-0 text-secondary">{{formatBytes($item ->size)}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h6 class="text-primary mb-0"><a title="download"
                                                                 download="{{substr($item-> name,11)}}"
                                                                 href="{{  asset('uploads/'.$item-> name) }}"
                                                                 class="btn-lg btn-link text-primary text-decoration-none"
                                                                 target="_blank" title="Download File">
                                        <i class="bx bx-download text-primary ml-1"
                                           style="font-size: 1.5rem"></i>
                                    </a></h6>
                            </td>
                            <td>
                                <div class="chip chip-md bg-light text-dark">
                                    <img
                                        src="{{ (!empty(\App\Models\User::find($item -> user_id)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> user_id)->photo) : url('upload/no_image.jpg')}}"
                                        alt="Contact Person">{{\App\Models\User::find($item -> user_id) -> name}}
                                </div>

                            </td>
                            <td>{{$item -> created_at -> format('H:i d/m/Y')}}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    @auth()
                                        @if(Auth::user()->role ==='manager' || Auth::user() -> id == $item -> user_id )
                                            <a href="{{ route('delete.file',$item->id) }}"
                                               id="delete"
                                               title="delete" class=""><i
                                                    class='bx bxs-trash text-danger'></i></a>
                                        @endif
                                    @endauth
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<script>
    $(document).ready(
        function () {
            $('input:file').change(
                function () {
                    if ($(this).val()) {
                        $('input:submit').attr('disabled', false);
                    }
                }
            );
        });
</script>

<script>
    function GetFileSizeNameAndType() {
        var fi = document.getElementById('inputFile'); // GET THE FILE INPUT AS VARIABLE.

        var totalFileSize = 0;

        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.
            for (var i = 0; i <= fi.files.length - 1; i++) {
                //ACCESS THE SIZE PROPERTY OF THE ITEM OBJECT IN FILES COLLECTION. IN THIS WAY ALSO GET OTHER PROPERTIES LIKE FILENAME AND FILETYPE
                var fsize = fi.files.item(i).size;
                totalFileSize = totalFileSize + fsize;
                document.getElementById('fp').innerHTML =
                    document.getElementById('fp').innerHTML
                    + '; ' + ' <b>' + fi.files.item(i).name

            }
        }
    }
</script>
@endsection
