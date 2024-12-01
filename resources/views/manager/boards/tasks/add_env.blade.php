@extends('manager.manager_dashboard')
@section('users')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class=" d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bxs-home-circle"></i></a>
                        </li>
                        {{--                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager.show.board', $board -> id)}}">{{$board -> name}} Board</a></li>--}}
                        <li class="breadcrumb-item active" aria-current="page">Add Env</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <form id="myForm" action="{{ route('manager.save.env') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h5 class="mb-4">Add Env - <span class="text-danger">Please enter with format item1;item2;item3...</span></h5>
                        <input type="hidden" name="task_id" value="{{$task -> id}}">
                        <div class="row mb-3">
                            <label for="task_id" class="col-sm-3 col-form-label">Parent Task</label>
                            <div class="col-sm-9">
                                <div class="position-relative">
                                    <input type="text" class="form-control" disabled
                                           value="{{$task ->jira_id.' - '. $task -> jira_summary}}"
                                           id="task_id">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">Emails</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="email" id="email" rows="3"
                                          placeholder="Enter email list ..."></textarea>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="browser" class="col-sm-3 col-form-label">Browsers</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="browser" id="browser" rows="3"
                                          placeholder="Enter browser list ..."></textarea>
                                @error('browser')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="player" class="col-sm-3 col-form-label">Players</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="player" id="player" rows="3"
                                          placeholder="Enter player list ..."></textarea>
                                @error('player')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="drop_date" class="col-sm-3 col-form-label">Drop Date</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="drop_date" id="drop_date" rows="3"
                                          placeholder="Enter drop date ..."></textarea>
                                @error('drop_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="build" class="col-sm-3 col-form-label">Builds</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="build" id="build" rows="3"
                                          placeholder="Enter build list ..."></textarea>
                                @error('build')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="device" class="col-sm-3 col-form-label">Devices</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="device" id="device" rows="3"
                                          placeholder="Enter device list ..."></textarea>
                                @error('device')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-5"><i
                                            class='bx bx-add-to-queue mr-1'></i>Save
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
