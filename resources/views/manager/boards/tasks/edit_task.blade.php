@extends('manager.manager_dashboard')
@section('users')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class=" d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager.show.board', $board -> id)}}">{{$board -> name}} Board</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Task</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <form id="myForm" action="{{ route('manager.update-task') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h5 class="mb-4">Edit Task</h5>
                        <input type="hidden" name="board_id" value="{{$board -> id}}">
                        <input type="hidden" name="task_id" value="{{$task -> id}}">
                        <div class="row mb-3">
                            <label for="project_name" class="col-sm-3 col-form-label">Board Name</label>
                            <div class="col-sm-9">
                                <div class="position-relative">
                                    <input type="text" class="form-control" disabled value="{{$board ->name}}"
                                           id="board_name">
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
                                            <option value="{{ $team->id }}" {{ $team->id == $task->team ? 'selected' : '' }}>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('team')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if($board_config -> type == 1)
                            <div class="row mb-3">
                                <label for="type" class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="type" id="type">
                                        <option selected="" disabled>Select Type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ $type->id == $task->type ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if($board_config -> jira_id == 1)
                            <div class="row mb-3">
                                <label for="jira_id" class="col-sm-3 col-form-label">Jira Id</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="jira_id" id="jira_id"
                                               placeholder="Enter Jira Id" value="{{$task ->jira_id }}">
                                    </div>
                                    @error('jira_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        @if($board_config -> jira_summary == 1)
                            <div class="row mb-3">
                                <label for="jira_summary" class="col-sm-3 col-form-label">Jira Summary</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="jira_summary" id="jira_summary"
                                               placeholder="Enter Jira Summary" value="{{$task ->jira_summary }}">
                                    </div>
                                    @error('jira_summary')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                            <option value="{{ $working_status->id }}" {{ $working_status->id == $task->working_status ? 'selected' : '' }}>{{ $working_status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('working_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if($board_config -> ticket_status == 1)
                            <div class="row mb-3">
                                <label for="ticket_status" class="col-sm-3 col-form-label">Ticket Status</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="ticket_status" id="ticket_status">
                                        <option selected="" disabled>Select Ticket Status</option>
                                        @foreach ($ticket_statuses as $ticket_status)
                                            <option value="{{ $ticket_status->id }}" {{ $ticket_status->id == $task->ticket_status ? 'selected' : '' }}>{{ $ticket_status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ticket_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if($board_config -> priority == 1)
                            <div class="row mb-3">
                                <label for="priority" class="col-sm-3 col-form-label">Priority</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="priority" id="priority">
                                        <option selected="" disabled>Select Priority</option>
                                        @foreach ($priorities as $priority)
                                            <option value="{{ $priority->id }}" {{ $priority->id == $task->priority ? 'selected' : '' }}>{{ $priority->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('$priority')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if($board_config -> link_to_result == 1)
                            <div class="row mb-3">
                                <label for="link_to_result" class="col-sm-3 col-form-label">Link To Result</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="link_to_result" id="link_to_result"
                                               placeholder="Enter Link To Result" value="{{$task ->link_to_result }}">
                                    </div>
                                    @error('link_to_result')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        @if($board_config -> test_plan == 1)
                            <div class="row mb-3">
                                <label for="test_plan" class="col-sm-3 col-form-label">Test Plan</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="test_plan" id="test_plan"
                                               placeholder="Enter Test Plan" value="{{$task ->test_plan }}">
                                    </div>
                                    @error('test_plan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        @if($board_config -> sprint == 1)
                            <div class="row mb-3">
                                <label for="test_plan" class="col-sm-3 col-form-label">Sprint</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="sprint" id="sprint"
                                               placeholder="Enter Sprint" value="{{$task ->sprint }}">
                                    </div>
                                    @error('sprint')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                            <option value="{{ $user->id }}" {{ $user->id == $task->tester_1 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tester_1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if($board_config -> tester_2 == 1)
                            <div class="row mb-3">
                                <label for="tester_2" class="col-sm-3 col-form-label">Tester 2</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="tester_2" id="tester_2">
                                        <option value="0">Select Tester</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == $task->tester_2 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tester_2')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if($board_config -> tester_3 == 1)
                            <div class="row mb-3">
                                <label for="tester_3" class="col-sm-3 col-form-label">Tester 3</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="tester_3" id="tester_3">
                                        <option value="0">Select Tester</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == $task->tester_3 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tester_3')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        @if($board_config -> tester_4 == 1)
                            <div class="row mb-3">
                                <label for="tester_4" class="col-sm-3 col-form-label">Tester 4</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="tester_4" id="tester_4">
                                        <option value="0" >Select Tester</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == $task->tester_4 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tester_4')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        @if($board_config -> tester_5 == 1)
                            <div class="row mb-3">
                                <label for="tester_5" class="col-sm-3 col-form-label">Tester 5</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="tester_5" id="tester_5">
                                        <option value="0" >Select Tester</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == $task->tester_5 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tester_5')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        @if($board_config -> pass == 1)
                            <div class="row mb-3">
                                <label for="pass" class="col-sm-3 col-form-label">Test Case Pass</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="number" class="form-control" name="pass" id="pass"
                                               placeholder="Enter Test Case Pass" value="{{$task ->pass }}">
                                        @error('pass')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($board_config -> fail == 1)
                            <div class="row mb-3">
                                <label for="fail" class="col-sm-3 col-form-label">Test Case Fail</label>
                                <div class="col-sm-9">
                                    <div class="position-relative">
                                        <input type="number" class="form-control" name="fail" id="fail"
                                               placeholder="Enter Test Case Fail" value="{{$task ->fail }}">
                                        @error('fail')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($board_config -> note == 1)
                        <div class="row mb-3">
                            <label for="note" class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="note" id="note" rows="3"
                                          placeholder="Enter the note ...">{{$task ->note }}</textarea>
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
                                            class='bx bxs-save mr-1'></i>Update
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
