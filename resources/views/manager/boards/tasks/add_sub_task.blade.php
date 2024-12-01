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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager.show.board', $board -> id)}}">{{$board -> name}} Board</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Sub Task</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <form id="myForm" action="{{ route('manager.save.sub-task') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h5 class="mb-4">New Task</h5>
                        <input type="hidden" name="board_id" value="{{$board -> id}}">
                        <div class="row mb-3">
                            <label for="project_name" class="col-sm-3 col-form-label">Board Name</label>
                            <div class="col-sm-9">
                                <div class="position-relative">
                                    <input type="text" class="form-control" disabled value="{{$board ->name}}"
                                           id="board_name">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="task_id" class="col-sm-3 col-form-label">Parent Task</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="task_id" value="{{$parent_task -> id}}">
                                <div class="position-relative">
                                    <input type="text" class="form-control" disabled
                                           value="{{$parent_task ->jira_id.' - '. $parent_task -> jira_summary}}"
                                           id="task_id">
                                </div>
                            </div>
                        </div>

                            <div class="row mb-3">
                                <label for="type" class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" disabled value="Sub Bug"
                                           id="type">
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jira_id" class="col-sm-3 col-form-label">Jira Id</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="jira_id" id="jira_id"
                                               placeholder="Enter Jira Id">
                                        @error('jira_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jira_summary" class="col-sm-3 col-form-label">Jira Summary</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="jira_summary" id="jira_summary"
                                               placeholder="Enter Jira Summary">
                                        @error('jira_summary')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

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
@endsection
