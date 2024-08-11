@extends('manager.manager_dashboard')
@section('users')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bxs-home-circle"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Team</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <form id="myForm" action="{{ route('manager.board.save-team') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h5 class="mb-4">New Team</h5>
                        <input type="hidden" name="board_id" value="{{$board -> id}}">
                        <div class="row mb-3">
                            <label for="project_name" class="col-sm-3 col-form-label">Board Name</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" disabled value="{{$board ->name}}"  id="board_name">
                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Team Name</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Enter Team Name">
                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                </div>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="desc" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" name="desc" id="desc"
                                           placeholder="Enter Description">
                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                </div>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-5"><i
                                            class='bx bx-add-to-queue mr-1'></i>Create
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary px-5"><i
                                            class='bx bx-reset mr-1'></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>


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
@endsection
