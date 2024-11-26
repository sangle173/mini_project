@extends('manager.manager_dashboard')
@section('users')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        .large-checkbox {
            transform: scale(1.5);
        }
    </style>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Files</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Files</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card card-item">
            <div class="card-body">
                <form id="myForm" action="{{ route('upload.files.user') }}" method="get" class="row g-3">
               
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="input-group">
                        <select name="user_id" class="form-select" id="inputGroupSelect04"
                                aria-label="Default select example">
                            <option selected="" disabled>Select folder</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" type="submit">Select Folder</button>
                    </div>
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered"
                           >
                        <thead>
                        <tr>
                            <th width="1.5%">#</th>
                            <th>File</th>
                            <th width="5%">Download</th>
                            <th>Uploaded by</th>
                            <th>Uploaded at</th>
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

                                            @case('MP4')
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
                                                <a href="{{  asset('uploads/'.$item-> name) }}" target="blank"
                                                   title="Review Files">{{substr($item-> name,11)}}</a>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
