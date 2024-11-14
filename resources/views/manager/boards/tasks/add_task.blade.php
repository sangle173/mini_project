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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager.show.board', $board -> id)}}">{{$board -> name}} Board</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Task</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <form id="myForm" action="{{ route('manager.tasks.save') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h5 class="mb-4">New Task</h5>
                        <input type="hidden" name="board_id" value="{{$board -> id}}">
                        <div class="row mb-3">
                            <label for="project_name" class="col-sm-3 col-form-label">Board Name</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" disabled value="{{$board ->name}}"
                                           id="board_name">
                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                </div>
                            </div>
                        </div>
                        @if($board_config -> team == 1)
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Team</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="team" id="name">
                                        <option selected="" disabled>Select Team</option>
                                        @foreach ($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('team')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif

                        @if($board_config -> type == 1)
                            <div class="row mb-3">
                                <label for="type" class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="type" id="type">
                                        <option selected="" disabled>Select Type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif

                        @if($board_config -> jira_id == 1)
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
                        @endif

                        @if($board_config -> jira_summary == 1)
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
                        @endif

                        @if($board_config -> working_status == 1)
                            <div class="row mb-3">
                                <label for="working_status" class="col-sm-3 col-form-label">Working Status</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="working_status" id="working_status">
                                        <option selected="" disabled>Select Working Status</option>
                                        @foreach ($working_statuses as $working_status)
                                            <option value="{{ $working_status->id }}">{{ $working_status->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('working_status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif

                        @if($board_config -> ticket_status == 1)
                            <div class="row mb-3">
                                <label for="ticket_status" class="col-sm-3 col-form-label">Ticket Status</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="ticket_status" id="ticket_status">
                                        <option selected="" disabled>Select Ticket Status</option>
                                        @foreach ($ticket_statuses as $ticket_status)
                                            <option value="{{ $ticket_status->id }}">{{ $ticket_status->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('ticket_status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif

                        @if($board_config -> priority == 1)
                            <div class="row mb-3">
                                <label for="priority" class="col-sm-3 col-form-label">Priority</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="priority" id="priority">
                                        <option selected="" disabled>Select Priority</option>
                                        @foreach ($priorities as $priority)
                                            <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('$priority')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif

                        @if($board_config -> link_to_result == 1)
                            <div class="row mb-3">
                                <label for="link_to_result" class="col-sm-3 col-form-label">Link To Result</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="link_to_result" id="link_to_result"
                                               placeholder="Enter Link To Result">
                                        @error('link_to_result')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        @endif

                        @if($board_config -> test_plan == 1)
                            <div class="row mb-3">
                                <label for="test_plan" class="col-sm-3 col-form-label">Test Plan</label>
                                <div class="col-sm-9">
                                    <div class="position-relative input-icon">
                                        <input type="text" class="form-control" name="test_plan" id="test_plan"
                                               placeholder="Enter Test Plan">
                                        <span class="position-absolute top-50 translate-middle-y"><i
                                                class='bx bx-user'></i></span>
                                        @error('test_plan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        @endif

                        @if($board_config -> sprint == 1)
                            <div class="row mb-3">
                                <label for="test_plan" class="col-sm-3 col-form-label">Sprint</label>
                                <div class="col-sm-9">
                                    <div class="position-relative input-icon">
                                        <input type="text" class="form-control" name="sprint" id="sprint"
                                               placeholder="Enter Sprint">
                                        <span class="position-absolute top-50 translate-middle-y"><i
                                                class='bx bx-user'></i></span>
                                        @error('sprint')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        @endif

                        @if($board_config -> tester_1 == 1)
                            <div class="row mb-3">
                                <label for="tester_1" class="col-sm-3 col-form-label">Tester 1</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="tester_1" id="tester_1">
                                        <option value="0">Select Tester</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tester_1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif

                        @if($board_config -> tester_2 == 1)
                            <div class="row mb-3">
                                <label for="tester_2" class="col-sm-3 col-form-label">Tester 2</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="tester_2" id="tester_2">
                                        <option value="0">Select Tester</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tester_2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif

                        @if($board_config -> tester_3 == 1)
                            <div class="row mb-3">
                                <label for="tester_3" class="col-sm-3 col-form-label">Tester 3</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="tester_3" id="tester_3">
                                        <option value="0">Select Tester</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tester_3')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif
                        @if($board_config -> tester_4 == 1)
                            <div class="row mb-3">
                                <label for="tester_4" class="col-sm-3 col-form-label">Tester 4</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="tester_4" id="tester_4">
                                        <option value="0">Select Tester</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tester_4')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif
                        @if($board_config -> tester_5 == 1)
                            <div class="row mb-3">
                                <label for="tester_5" class="col-sm-3 col-form-label">Tester 5</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="tester_5" id="tester_5">
                                        <option value="0">Select Tester</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tester_5')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif
                        @if($board_config -> note == 1)
                        <div class="row mb-3">
                            <label for="note" class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="note" id="note" rows="3"
                                          placeholder="Enter the note ..."></textarea>
                                @error('note')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif

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
{{--    <script>--}}
{{--        $('#type').change(function(e){--}}
{{--            if($(this).val() == "1"){--}}
{{--                $("#working_status").prop('disabled',true);--}}
{{--                $("#link_to_result").prop('disabled',true);--}}
{{--                $("#tester_2").prop('disabled',true);--}}
{{--                $("#tester_3").prop('disabled',true);--}}
{{--                $("#tester_4").prop('disabled',true);--}}
{{--                $("#tester_5").prop('disabled',true);--}}
{{--            }--}}
{{--            // else {--}}
{{--            //     $("#size option[value='Medium']").prop('disabled',false);--}}
{{--            // }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
