@extends('manager.manager_dashboard')
@section('users')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        .large-checkbox {
            transform: scale(1.5);
        }

        .nav-pills > li > a.active {
            background-color: #FFE800 !important;
            color: black !important;
        }
    </style>

    <div class="container-fluid">

        <!--breadcrumb-->
        <div class="d-none d-sm-flex align-items-center"
             style="margin-bottom: 1px!important;padding-top: 5px!important;">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{route('manager.all.boards')}}">All Board</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$board -> name}} Today Tasks</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto mb-1">
                <div class="btn-group">
                    <div class="col" >
                        <!-- Button trigger modal -->
                        <button type="button" class="btn" style="background-color: #754FFE;color: white"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i
                                class='bx bx-add-to-queue mr-1'></i>Add Task
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="myForm" action="{{ route('manager.tasks.save') }}" method="post"
                                              class="row g-3" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="board_id" value="{{$board -> id}}">
                                            @if($board_config -> team == 1)
                                                <label for="team" class="col-md-2 col-form-label ">Team</label>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="team" id="team">
                                                        <option selected="" disabled>Choose...</option>
                                                        @foreach ($teams as $team)
                                                            <option
                                                                value="{{ $team->id }}">{{ $team->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('team')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> type == 1)
                                                <label for="type" class="col-md-2 col-form-label ">Type <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <select  class="form-select" name="type" id="type" required>
                                                        <option selected="" disabled>Choose...</option>
                                                        @foreach ($types as $type)
                                                            <option
                                                                value="{{ $type->id }}">{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>

                                            @endif
                                            @if($board_config -> jira_id == 1)
                                                <label for="jira_id" class="col-md-2 col-form-label ">Jira
                                                    Id</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="jira_id" id="jira_id"
                                                           placeholder="Enter Jira Id">
                                                    @error('jira_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> jira_summary == 1)
                                                <label for="jira_summary" class="col-md-2 col-form-label ">Jira
                                                    Summary <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="jira_summary"
                                                           id="jira_summary"
                                                           placeholder="Enter Jira Summary" required>
                                                    @error('jira_summary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif

                                            @if($board_config -> working_status == 1)
                                                <label for="working_status" class="col-md-2 col-form-label ">Working
                                                    Status <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="working_status"
                                                            id="working_status">
                                                        <option selected="" disabled>Choose...</option>
                                                        @foreach ($working_statuses as $working_status)
                                                            <option
                                                                value="{{ $working_status->id }}">{{ $working_status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('working_status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> ticket_status == 1)
                                                <label for="ticket_status" class="col-md-2 col-form-label ">Ticket
                                                    Status <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="ticket_status"
                                                            id="ticket_status">
                                                        <option selected="" disabled>Choose...</option>
                                                        @foreach ($ticket_statuses as $ticket_status)
                                                            <option
                                                                value="{{ $ticket_status->id }}">{{ $ticket_status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('ticket_status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> priority == 1)
                                                <label for="priority"
                                                       class="col-md-2 col-form-label ">Priority</label>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="priority" id="priority">
                                                        <option selected="" disabled>Choose...</option>
                                                        @foreach ($priorities as $priority)
                                                            <option
                                                                value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('$priority')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> link_to_result == 1)
                                                <label for="link_to_result" class="col-md-2 col-form-label ">Link To
                                                    Result</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="link_to_result"
                                                           id="link_to_result"
                                                           placeholder="Enter Link">
                                                    @error('link_to_result')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                            @if($board_config -> test_plan == 1)
                                                <label for="test_plan" class="col-md-2 col-form-label ">Test
                                                    Plan</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="test_plan"
                                                           id="test_plan"
                                                           placeholder="Enter Test Plan">
                                                    @error('test_plan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>

                                            @endif
                                            @if($board_config -> sprint == 1)
                                                <label for="sprint" class="col-md-2 col-form-label ">Sprint</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="sprint" id="sprint"
                                                           placeholder="Enter Sprint">
                                                    @error('sprint')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> tester_1 == 1)
                                                <label for="tester_1" class="col-md-2 col-form-label ">Tester 1 <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="tester_1" id="tester_1">
                                                        <option value="{{ $currentUser->id }}">{{ $currentUser->name }}
                                                            (You)
                                                        </option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tester_1')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> tester_2 == 1)
                                                <label for="tester_2" class="col-md-2 col-form-label ">Tester 2</label>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="tester_2" id="tester_2">
                                                        <option value="0">Choose...</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tester_2')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> tester_3 == 1)
                                                <label for="tester_3" class="col-md-2 col-form-label ">Tester 3</label>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="tester_3" id="tester_3">
                                                        <option value="0">Choose...</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tester_3')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> tester_4 == 1)
                                                <label for="tester_4" class="col-md-2 col-form-label ">Tester 4</label>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="tester_4" id="tester_4">
                                                        <option value="0">Choose...</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tester_4')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> tester_5 == 1)
                                                <label for="tester_5" class="col-md-2 col-form-label ">Tester 5</label>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="tester_5" id="tester_5">
                                                        <option value="0">Choose...</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tester_5')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> pass == 1)
                                                <label for="pass" class="col-md-2 col-form-label ">Test Case
                                                    Pass</label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="pass" id="pass"
                                                           placeholder="Enter Test Case Pass">
                                                    @error('pass')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> fail == 1)
                                                <label for="fail" class="col-md-2 col-form-label ">Test Case
                                                    Fail</label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="fail" id="fail"
                                                           placeholder="Enter Test Case Fail">
                                                    @error('fail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5"></div>
                                            @endif
                                            @if($board_config -> note == 1)
                                                <label for="note" class="col-md-2 col-form-label ">Note</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="note" id="note" rows="3"
                                                              placeholder="Enter the note ..."></textarea>
                                                    @error('note')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="submit" id="submitbtn" class="btn text-white" style="background-color: #754FFE;">
                                            Add Task
                                        </button>
                                    </div>
                                    </form>
                                    @if (count($errors) > 0)
                                        <script>
                                            $( document ).ready(function() {
                                                $('#exampleModal').modal('show');
                                            });
                                        </script>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container-fluid mt-1">
            <div class="card-body p-4">
                <form class="row g-3" action="{{ route('manager.task.filter') }}" method="get">
                    <input type="hidden" name="board_id" value="{{$board-> id}}">
                    <div class="col-md-2">
                        <label for="type" class="form-label">Date</label>
                        <div class="position-relative">
                            @if(isset($request))
                                <input class="form-control" type="date" value="{{$request -> date}}" name="date">
                            @else
                                <input class="form-control" value="<?php echo date('Y-m-d'); ?>" type="date"
                                       name="date">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="team" class="form-label">Team</label>
                        <div class="position-relative">
                            <select class="form-select" name="team" id="name">
                                <option disabled selected>Choose...</option>
                                @foreach ($teams as $team)
                                    @if(isset($request))
                                        <option
                                            value="{{ $team->id }}" {{ $team->id == $request-> team ? 'selected' : '' }}>{{ $team->id == $request-> team ? \App\Models\Team::find($request -> team) -> name : $team -> name}}</option>
                                    @else
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="type" class="form-label">Type</label>
                        <div class="position-relative">
                            <select class="form-select" name="type" id="type">
                                <option disabled selected>Choose...</option>
                                @foreach ($types as $type)
                                    @if(isset($request))
                                        <option
                                            value="{{ $type->id }}" {{ $type->id == $request-> type ? 'selected' : '' }}>{{ $type->id == $request-> type ? \App\Models\Type::find($request -> type) -> name : $type -> name}}</option>
                                    @else
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="tester" class="form-label">Tester</label>
                        <select class="form-select" name="tester" id="tester">
                            <option disabled selected>Choose...</option>
                            @foreach ($users as $user)
                                @if(isset($request))
                                    <option
                                        value="{{ $user->id }}" {{ $user->id == $request-> tester ? 'selected' : '' }}>{{ $user->id == $request-> tester ? \App\Models\User::find($request -> tester) -> name : $user -> name}}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="input22" class="form-label">
                            Filter
                        </label>
                        <div class="position-relative">
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    @if(isset($request))
                                        <button type="submit" class="btn" style="background-color: #FFE800"><i
                                                class="bx bx-filter"></i>Filtered
                                        </button>
                                    @else
                                        <button type="submit" class="btn px-4" style="background-color: #FFE800"><i
                                                class="bx bx-filter"></i>Filter
                                        </button>
                                    @endif
                                    <a href="{{route('manager.show.board', $board-> id)}}"
                                       class="btn btn-secondary px-4" type="reset">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills nav-pills mb-0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="pill" href="#tag-config" role="tab"
                           aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
                                </div>
                                <div class="tab-title"> Tasks</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="pill" href="#primaryprofile" role="tab"
                           aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-mail-send font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Report Outlook</div>
                            </div>
                        </a>
                    </li>
                    @if($board -> id == 1)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#slack_report" role="tab"
                               aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-chat font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Report Slack</div>
                                </div>
                            </a>
                        </li>
                    @endif
                    @if($board -> id == 5)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#sprint_report" role="tab"
                               aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-bookmark-alt font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Sprint Report</div>
                                </div>
                            </a>
                        </li>
                    @endif
                    @auth()
                        @if(Auth::user()->role ==='manager')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="pill" href="#reportconfig" role="tab"
                                   aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-cog font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">Report Config</div>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endauth
                    @auth()
                        @if(Auth::user()->role ==='manager')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                                   aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-cog font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">Board Config</div>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <div class="tab-content pt-3">
                    <div class="tab-pane fade show active" id="tag-config" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table data-page-length='50' id="example" class="table table-striped table-bordered"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            @if($board_config-> type != null)
                                                <th>Type</th>
                                            @endif
                                            @if($board_config-> team != null)
                                                <th>Team</th>
                                            @endif
                                            @if($board_config-> jira_summary != null)
                                                <th>Jira Summary</th>
                                            @endif
                                            @if($board_config-> working_status != null)
                                                <th>Working Status</th>
                                            @endif
                                            @if($board_config-> ticket_status != null)
                                                <th>Ticket Status</th>
                                            @endif
                                            @if($board_config-> priority != null)
                                                <th>Priority</th>
                                            @endif
                                            @if($board_config-> isSubBug != null)
                                                <th>Bugs</th>
                                            @endif
                                            @if($board_config-> link_to_result != null)
                                                <th>Link To Result</th>
                                            @endif
                                            @if($board_config-> test_plan != null)
                                                <th>Test Plan</th>
                                            @endif
                                            @if($board_config-> sprint != null)
                                                <th>Sprint</th>
                                            @endif
                                            @if($board_config-> tester_1 != null)
                                                <th>Testers</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($tasks as $key=> $item)
                                            <tr>
                                                <td><a href="{{ route('task.details',$item->id) }}"
                                                       title="View" class="text-black">{{ $key+1 }}</a></td>
                                                @if($board_config-> type != 0)
                                                    <td>
                                                        @switch($item-> type)
                                                            @case('1')
                                                            <i class="bx bxs-bug text-danger font-18"
                                                               style="font-size: 1.2rem" title="Bugs Reported"></i>
                                                            @break
                                                            @case('2')
                                                            <i class="bx bxs-check-square text-primary"
                                                               style="font-size: 1.2rem" title="Testing Requests"></i>
                                                            @break
                                                            @case('3')
                                                            <i class="bx bxs-news text-success"
                                                               style="font-size: 1.2rem"
                                                               title="Tickets Verification"></i>
                                                            @break
                                                            @default
                                                            <span
                                                                class="badge"
                                                                style="background-color: {{\App\Models\Type::find($item-> type) -> desc}}">{{\App\Models\Type::find($item-> type) -> name}} </span>
                                                        @endswitch
                                                    </td>
                                                @endif
                                                @if($board_config-> team != 0)
                                                    <td>
                                                        @if($item-> team !=null)
                                                            {{\App\Models\Team::find($item-> team) -> name}}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> jira_summary != 0)
                                                    <td style="width: 15%">
                                                        @if($item-> jira_summary !=null)
                                                            <a href="{{url($board_config -> jira_url . $item-> jira_id) }}"
                                                               target="_blank">{{ $item->jira_id }}</a>
                                                            - {{ \Illuminate\Support\Str::limit($item->jira_summary, 40, $end=' ...') }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> working_status != 0)
                                                    <td>
                                                        @if($item-> working_status !=null)

                                                            <a type="button" data-bs-toggle="modal"
                                                               data-bs-target="#update_working_status{{$item -> id}}">
                                                                <span
                                                                    class="badge"
                                                                    style="background-color: {{\App\Models\WorkingStatus::find($item-> working_status) -> desc}}">{{\App\Models\WorkingStatus::find($item-> working_status) -> name}} </span>
                                                            </a>
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                 id="update_working_status{{$item -> id}}" tabindex="-1"
                                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-light">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">Update Working
                                                                                Status <a
                                                                                    href="{{url($board_config -> jira_url . \App\Models\Task::find($item -> id)-> jira_id) }}"
                                                                                    target="_blank">{{ \App\Models\Task::find($item -> id)->jira_id }}</a>
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                        </div>
                                                                        <form id="myForm"
                                                                              action="{{ route('manager.update-working-status') }}"
                                                                              method="post"
                                                                              class="row g-3"
                                                                              enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="board_id"
                                                                                   value="{{$board -> id}}">
                                                                            <input type="hidden" name="task_id"
                                                                                   value="{{$item -> id}}">
                                                                            <div class="modal-body">
                                                                                <div class="col-md-12">
                                                                                    <label for="working_status"
                                                                                           class="form-label ">Working
                                                                                        Status</label>
                                                                                    <select class="form-select"
                                                                                            name="working_status"
                                                                                            id="working_status">
                                                                                        @foreach ($working_statuses as $working_status)
                                                                                            <option
                                                                                                value="{{ $working_status->id }}" {{ $working_status->id == \App\Models\Task::find($item -> id)->working_status ? 'selected' : '' }}>{{ $working_status->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('working_status')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn text-white"
                                                                                        style="background-color: #754FFE;">
                                                                                    Update
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> ticket_status != 0)
                                                    <td>
                                                        @if($item-> ticket_status !=null)

                                                            <a type="button" data-bs-toggle="modal"
                                                               data-bs-target="#update_ticket_status{{$item -> id}}">
                                                                <span
                                                                    class="badge"
                                                                    style="background-color: {{\App\Models\TicketStatus::find($item-> ticket_status) -> desc}}">{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}}</span>
                                                            </a>
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                 id="update_ticket_status{{$item -> id}}" tabindex="-1"
                                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-light">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">Update Ticket
                                                                                Status <a
                                                                                    href="{{url($board_config -> jira_url . \App\Models\Task::find($item -> id)-> jira_id) }}"
                                                                                    target="_blank">{{ \App\Models\Task::find($item -> id)->jira_id }}</a>
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                        </div>
                                                                        <form id="myForm"
                                                                              action="{{ route('manager.update-ticket-status') }}"
                                                                              method="post"
                                                                              class="row g-3"
                                                                              enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="board_id"
                                                                                   value="{{$board -> id}}">
                                                                            <input type="hidden" name="task_id"
                                                                                   value="{{$item -> id}}">
                                                                            <div class="modal-body">
                                                                                <div class="col-md-12">
                                                                                    <label for="ticket_status"
                                                                                           class="form-label ">Ticket
                                                                                        Status</label>
                                                                                    <select class="form-select"
                                                                                            name="ticket_status"
                                                                                            id="ticket_status">
                                                                                        @foreach ($ticket_statuses as $ticket_status)
                                                                                            <option
                                                                                                value="{{ $ticket_status->id }}" {{ $ticket_status->id == \App\Models\Task::find($item -> id)->ticket_status ? 'selected' : '' }}>{{ $ticket_status->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('ticket_status')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn text-white"
                                                                                        style="background-color: #754FFE;">
                                                                                    Update
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </td>
                                                @endif
                                                @if($board_config-> priority != 0)
                                                    <td>
                                                        @if($item-> priority !=null)
                                                            {{\App\Models\Priority::find($item-> priority) -> name}}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> isSubBug != '0')
                                                    <td>
                                                        <span
                                                            class="badge bg-danger rounded-pill">{{count(\App\Models\Task::where('parent_task_id', $item -> id) ->latest()->get())}}</span>
                                                    </td>
                                                @endif
                                                @if($board_config-> link_to_result != 0)
                                                    <td>
                                                        @if($item-> link_to_result !=null)
                                                            <a target="_blank" href=" {{ $item->link_to_result }}">Link
                                                                To Result</a>
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> test_plan != 0)
                                                    <td>
                                                        @if($item-> test_plan !=null)
                                                            <a target="_blank"
                                                               href="{{ url('https://sonos.testrail.com/index.php?/plans/view/'.$item->test_plan) }}">{{$item->test_plan}}</a>
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> sprint != 0)
                                                    <td>
                                                        @if($item-> test_plan !=null)
                                                            {{ $item->sprint }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> tester_1 != 0)
                                                    <td>
                                                        <div style="margin-left: 15px!important;"
                                                             class="user-groups ms-auto">
                                                            @if($item-> tester_1 !=null || $item-> tester_1 !=0 )
                                                                <img
                                                                    src="{{ (!empty(\App\Models\User::find($item -> tester_1)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_1)->photo) : url('upload/no_image.jpg')}}"
                                                                    width="35" height="35" class="rounded-circle"
                                                                    title="{{\App\Models\User::find($item -> tester_1)-> name}}"
                                                                    alt=""/>
                                                            @endif
                                                            @if($item-> tester_2 !=null || $item-> tester_2 !=0 )
                                                                <img
                                                                    src="{{ (!empty(\App\Models\User::find($item -> tester_2)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_2)->photo) : url('upload/no_image.jpg')}}"
                                                                    width="35" height="35" class="rounded-circle"
                                                                    title="{{\App\Models\User::find($item -> tester_2)-> name}}"
                                                                    alt=""/>
                                                            @endif
                                                            @if($item-> tester_3 !=null || $item-> tester_3 !=0 )
                                                                <img
                                                                    src="{{ (!empty(\App\Models\User::find($item -> tester_3)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_3)->photo) : url('upload/no_image.jpg')}}"
                                                                    width="35" height="35" class="rounded-circle"
                                                                    title="{{\App\Models\User::find($item -> tester_3)-> name}}"
                                                                    alt=""/>
                                                            @endif
                                                            @if($item-> tester_4 !=null || $item-> tester_4 !=0 )
                                                                <img
                                                                    src="{{ (!empty(\App\Models\User::find($item -> tester_4)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_4)->photo) : url('upload/no_image.jpg')}}"
                                                                    width="35" height="35" class="rounded-circle"
                                                                    title="{{\App\Models\User::find($item -> tester_4)-> name}}"
                                                                    alt=""/>
                                                            @endif
                                                            @if($item-> tester_5 !=null || $item-> tester_5 !=0 )
                                                                <img
                                                                    src="{{ (!empty(\App\Models\User::find($item -> tester_1)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_5)->photo) : url('upload/no_image.jpg')}}"
                                                                    width="35" height="35" class="rounded-circle"
                                                                    title="{{\App\Models\User::find($item -> tester_5)-> name}}"
                                                                    alt=""/>
                                                            @endif
                                                        </div>
                                                    </td>
                                                @endif

                                                <td>
                                                    <div class="d-flex order-actions">
                                                        <a href="{{ route('task.details',$item->id) }}"
                                                           title="View" class=""><i
                                                                class='lni lni-eye text-success'></i></a>
                                                        <a href="{{ route('manager.clone.task',$item->id) }}"
                                                           title="Clone" class=""><i
                                                                class='bx bxs-copy text-info'></i></a>
                                                        @auth()
                                                            @if(Auth::user()->role ==='manager' || Auth::user() -> id == $item -> tester_1 )
                                                                {{--                                                                <a href="{{ route('manager.edit.task',$item->id) }}"--}}
                                                                {{--                                                                   title="Edit" class=""><i--}}
                                                                {{--                                                                        class='bx bxs-edit text-primary'></i></a>--}}
                                                                <a type="button" class="btn-sm btn-mute"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#edit{{$item->id}}"><i
                                                                        class='bx bxs-edit text-primary'></i>
                                                                </a>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="edit{{$item->id}}"
                                                                     tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-light">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">Update
                                                                                    Task</h5>
                                                                                <button type="button" class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form id="myForm"
                                                                                      action="{{ route('manager.update-task') }}"
                                                                                      method="post"
                                                                                      class="row g-3"
                                                                                      enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <input type="hidden" name="board_id"
                                                                                           value="{{$board -> id}}">
                                                                                    <input type="hidden" name="task_id"
                                                                                           value="{{$item -> id}}">
                                                                                    @if($board_config -> team == 1)
                                                                                        <label for="name"
                                                                                               class="col-md-2 col-form-label ">Team</label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="team"
                                                                                                    id="name">
                                                                                                <option selected=""
                                                                                                        disabled>
                                                                                                    Choose...
                                                                                                </option>
                                                                                                @foreach ($teams as $team)
                                                                                                    <option
                                                                                                        value="{{ $team->id }}" {{ $team->id == \App\Models\Task::find($item -> id)-> team ? 'selected' : '' }}>{{ $team->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('team')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> type == 1)
                                                                                        <label for="type"
                                                                                               class="col-md-2 col-form-label ">Type
                                                                                            <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="type"
                                                                                                    id="type">
                                                                                                <option selected=""
                                                                                                        disabled>
                                                                                                    Choose...
                                                                                                </option>
                                                                                                @foreach ($types as $type)
                                                                                                    <option
                                                                                                        value="{{ $type->id }}" {{ $type->id == \App\Models\Task::find($item -> id)->type ? 'selected' : '' }}>{{ $type->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('type')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>

                                                                                    @endif
                                                                                    @if($board_config -> jira_id == 1)
                                                                                        <label for="jira_id"
                                                                                               class="col-md-2 col-form-label ">Jira
                                                                                            Id</label>
                                                                                        <div class="col-md-5">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="jira_id"
                                                                                                   id="jira_id"
                                                                                                   placeholder="Enter Jira Id"
                                                                                                   value="{{\App\Models\Task::find($item -> id) ->jira_id }}">
                                                                                            @error('jira_id')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> jira_summary == 1)
                                                                                        <label for="jira_summary"
                                                                                               class="col-md-2 col-form-label ">Jira
                                                                                            Summary <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <div class="col-md-10">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="jira_summary"
                                                                                                   id="jira_summary"
                                                                                                   placeholder="Enter Jira Summary"
                                                                                                   value="{{\App\Models\Task::find($item -> id) ->jira_summary }}">
                                                                                            @error('jira_summary')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    @endif
                                                                                    @if($board_config -> working_status == 1)
                                                                                        <label for="working_status"
                                                                                               class="col-md-2 col-form-label ">Working
                                                                                            Status <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="working_status"
                                                                                                    id="working_status">
                                                                                                <option selected=""
                                                                                                        disabled>
                                                                                                    Choose...
                                                                                                </option>
                                                                                                @foreach ($working_statuses as $working_status)
                                                                                                    <option
                                                                                                        value="{{ $working_status->id }}" {{ $working_status->id == \App\Models\Task::find($item -> id)->working_status ? 'selected' : '' }}>{{ $working_status->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('working_status')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> ticket_status == 1)
                                                                                        <label for="ticket_status"
                                                                                               class="col-md-2 col-form-label ">Ticket
                                                                                            Status <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="ticket_status"
                                                                                                    id="ticket_status">
                                                                                                <option selected=""
                                                                                                        disabled>
                                                                                                    Choose...
                                                                                                </option>
                                                                                                @foreach ($ticket_statuses as $ticket_status)
                                                                                                    <option
                                                                                                        value="{{ $ticket_status->id }}" {{ $ticket_status->id == \App\Models\Task::find($item -> id)->ticket_status ? 'selected' : '' }}>{{ $ticket_status->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('ticket_status')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> priority == 1)
                                                                                        <label for="priority"
                                                                                               class="col-md-2 col-form-label ">Priority</label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="priority"
                                                                                                    id="priority">
                                                                                                <option selected=""
                                                                                                        disabled>
                                                                                                    Choose...
                                                                                                </option>
                                                                                                @foreach ($priorities as $priority)
                                                                                                    <option
                                                                                                        value="{{ $priority->id }}" {{ $priority->id == \App\Models\Task::find($item -> id)->priority ? 'selected' : '' }}>{{ $priority->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('$priority')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> link_to_result == 1)
                                                                                        <label for="link_to_result"
                                                                                               class="col-md-2 col-form-label ">Link
                                                                                            To
                                                                                            Result</label>
                                                                                        <div class="col-md-10">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="link_to_result"
                                                                                                   id="link_to_result"
                                                                                                   placeholder="Enter Link To Result"
                                                                                                   value="{{\App\Models\Task::find($item -> id) ->link_to_result }}">
                                                                                            @error('link_to_result')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    @endif
                                                                                    @if($board_config -> test_plan == 1)
                                                                                        <label for="test_plan"
                                                                                               class="col-md-2 col-form-label ">Test
                                                                                            Plan</label>
                                                                                        <div class="col-md-5">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="test_plan"
                                                                                                   id="test_plan"
                                                                                                   placeholder="Enter Test Plan"
                                                                                                   value="{{\App\Models\Task::find($item -> id) ->test_plan }}">
                                                                                            @error('test_plan')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>

                                                                                    @endif
                                                                                    @if($board_config -> sprint == 1)
                                                                                        <label for="sprint"
                                                                                               class="col-md-2 col-form-label ">Sprint</label>
                                                                                        <div class="col-md-5">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="sprint"
                                                                                                   id="sprint"
                                                                                                   placeholder="Enter Sprint"
                                                                                                   value="{{\App\Models\Task::find($item -> id) ->sprint }}">
                                                                                            @error('sprint')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> tester_1 == 1)
                                                                                        <label for="tester_1"
                                                                                               class="col-md-2 col-form-label ">Tester
                                                                                            1 <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="tester_1"
                                                                                                    id="tester_1">
                                                                                                <option
                                                                                                    value="{{ $currentUser->id }}">{{ $currentUser->name }}
                                                                                                    (You)
                                                                                                </option>
                                                                                                @foreach ($users as $user)
                                                                                                    <option
                                                                                                        value="{{ $user->id }}" {{ $user->id == \App\Models\Task::find($item -> id)->tester_1 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('tester_1')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> tester_2 == 1)
                                                                                        <label for="tester_2"
                                                                                               class="col-md-2 col-form-label ">Tester
                                                                                            2</label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="tester_2"
                                                                                                    id="tester_2">
                                                                                                <option value="0">
                                                                                                    Choose...
                                                                                                </option>
                                                                                                @foreach ($users as $user)
                                                                                                    <option
                                                                                                        value="{{ $user->id }}" {{ $user->id == \App\Models\Task::find($item -> id)->tester_2 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('tester_2')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> tester_3 == 1)
                                                                                        <label for="tester_3"
                                                                                               class="col-md-2 col-form-label ">Tester
                                                                                            3</label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="tester_3"
                                                                                                    id="tester_3">
                                                                                                <option value="0">
                                                                                                    Choose...
                                                                                                </option>
                                                                                                @foreach ($users as $user)
                                                                                                    <option
                                                                                                        value="{{ $user->id }}" {{ $user->id == \App\Models\Task::find($item -> id)->tester_3 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('tester_3')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> tester_4 == 1)
                                                                                        <label for="tester_4"
                                                                                               class="col-md-2 col-form-label ">Tester
                                                                                            4</label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="tester_4"
                                                                                                    id="tester_4">
                                                                                                <option value="0">
                                                                                                    Choose...
                                                                                                </option>
                                                                                                @foreach ($users as $user)
                                                                                                    <option
                                                                                                        value="{{ $user->id }}" {{ $user->id == \App\Models\Task::find($item -> id)->tester_4 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('tester_4')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> tester_5 == 1)
                                                                                        <label for="tester_5"
                                                                                               class="col-md-2 col-form-label ">Tester
                                                                                            5</label>
                                                                                        <div class="col-md-5">
                                                                                            <select class="form-select"
                                                                                                    name="tester_5"
                                                                                                    id="tester_5">
                                                                                                <option value="0">
                                                                                                    Choose...
                                                                                                </option>
                                                                                                @foreach ($users as $user)
                                                                                                    <option
                                                                                                        value="{{ $user->id }}" {{ $user->id == \App\Models\Task::find($item -> id)->tester_5 ? 'selected' : '' }}>{{ $user->name }} {{ $user->id == $currentUser->id ? '(You)' : '' }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('tester_5')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> pass == 1)
                                                                                        <label for="pass"
                                                                                               class="col-md-2 col-form-label ">Test
                                                                                            Case Pass</label>
                                                                                        <div class="col-md-5">
                                                                                            <input type="number"
                                                                                                   class="form-control"
                                                                                                   name="pass" id="pass"
                                                                                                   placeholder="Enter Test Case Pass"
                                                                                                   value="{{\App\Models\Task::find($item -> id) ->pass }}">
                                                                                            @error('pass')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> fail == 1)
                                                                                        <label for="fail"
                                                                                               class="col-md-2 col-form-label ">Test
                                                                                            Case Fail</label>
                                                                                        <div class="col-md-5">
                                                                                            <input type="number"
                                                                                                   class="form-control"
                                                                                                   name="fail" id="fail"
                                                                                                   placeholder="Enter Test Case Fail"
                                                                                                   value="{{\App\Models\Task::find($item -> id) ->fail }}">
                                                                                            @error('fail')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-5"></div>
                                                                                    @endif
                                                                                    @if($board_config -> note == 1)
                                                                                        <label for="note"
                                                                                               class="col-md-2 col-form-label ">Note</label>
                                                                                        <div class="col-md-10">
                                                    <textarea
                                                        class="form-control"
                                                        name="note" id="note"
                                                        rows="3"
                                                        placeholder="Enter the note ...">{{\App\Models\Task::find($item -> id) ->note }}</textarea>
                                                                                            @error('note')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                @endif

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn text-white"
                                                                                        style="background-color: #754FFE;">
                                                                                    Update
                                                                                </button>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @endauth
                                                                </div>
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
                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        @if($board -> id == 1)
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <div class="row">
                                            <h4>
                                                {{$final_subject }}
                                                <a href="{{url('mailto:?subject='.$final_subject.'&cc='.$report_config -> cc)}}"
                                                   class="ml-3 btn btn-primary float-end"><i
                                                        class="bi bi-cloud-arrow-up"></i> Open Outlook</a>
                                                <button class="ml-3 btn btn-info float-end" onclick="copyFunction()"><i
                                                        class="bi bi-copy"></i> Copy
                                                </button>
                                            </h4>
                                        </div>
                                        <div class="row">
                                            <b>CC List:</b> <br>{{$report_config -> cc}}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="divExp" class="divExp">
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;;color: black"><a
                                                            name="_Hlk155304048">Hi Roger,</a></span></font></div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;;color: black">Below is our status report for today. Please review and let us know if you have any comments or questions.</span></font>
                                            </div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            size="4"><span
                                                                style="font-size:14pt;"><b>&nbsp;</b></span></font></span></font>
                                            </div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            size="4"><span
                                                                style="font-size:14pt;;color: black"><b>Summary:</b></span></font></span></font>
                                            </div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><b>&nbsp;</b></span></font></div>
                                            <table border="0" cellspacing="0" cellpadding="0" width="600"
                                                   style="width:449.75pt;border-collapse:collapse">
                                                <tbody>
                                                <tr style="height:28.75pt">
                                                    <td width="199" nowrap="" rowspan="2"
                                                        style="width:149pt;border:1pt solid windowtext;background:rgb(189,215,238);padding:0in 5.4pt;height:28.75pt">
                                                        <p class="MsoNormal" align="center"
                                                           style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                            <b><span style="color:black">Team</span></b></p>
                                                    </td>
                                                    <td width="161" colspan="2"
                                                        style="width:121pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(189,215,238);padding:0in 5.4pt;height:28.75pt">
                                                        <p class="MsoNormal" align="center"
                                                           style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                            <b><span style="color:black">Testing
       requests</span></b></p>
                                                    </td>
                                                    <td width="148" colspan="2"
                                                        style="width:111pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(189,215,238);padding:0in 5.4pt;height:28.75pt">
                                                        <p class="MsoNormal" align="center"
                                                           style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                            <b><span style="color:black">Tickets
       verification</span></b></p>
                                                    </td>
                                                    <td width="92" nowrap="" rowspan="2"
                                                        style="width:68.75pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(189,215,238);padding:0in 5.4pt;height:28.75pt">
                                                        <p class="MsoNormal" align="center"
                                                           style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                            <b><span style="color:black">Bugs
       reported</span></b></p>
                                                    </td>
                                                </tr>
                                                <tr style="height:15pt">
                                                    <td width="84" nowrap=""
                                                        style="width:63.25pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:rgb(189,215,238);padding:0in 5.4pt;height:15pt">
                                                        <p class="MsoNormal"
                                                           style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                            <span style="color:black">Done</span></p>
                                                    </td>
                                                    <td width="84" nowrap=""
                                                        style="width:66pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:rgb(189,215,238);padding:0in 5.4pt;height:15pt">
                                                        <p class="MsoNormal"
                                                           style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                            <span style="color:black">In-progress</span></p>
                                                    </td>
                                                    <td width="82" nowrap=""
                                                        style="width:61.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:rgb(189,215,238);padding:0in 5.4pt;height:15pt">
                                                        <p class="MsoNormal"
                                                           style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                            <span style="color:black">Done</span></p>
                                                    </td>
                                                    <td width="82" nowrap=""
                                                        style="width:66pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:rgb(189,215,238);padding:0in 5.4pt;height:15pt">
                                                        <p class="MsoNormal"
                                                           style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                            <span style="color:black">In-progress</span></p>
                                                    </td>
                                                </tr>
                                                @foreach ($teams as $key => $team)
                                                    @if(
    count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0
    || count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0
    || count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0
    || count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0
    || count(\App\Models\Task::where('team', $team -> id) -> where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0  )
                                                        <tr style="height:15pt">
                                                            <td width="199" valign="bottom"
                                                                style="background-color: {{$team -> desc}};width:149pt;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:1pt solid windowtext;border-top:none;padding:0in 5.4pt;height:15pt">
                                                                <p class="MsoNormal"
                                                                   style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                                    <span style="color:black">{{$team -> name}}</span>
                                                                </p>
                                                            </td>
                                                            <td width="84" nowrap=""
                                                                style="background-color: {{$team -> desc}};width:63.25pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;padding:0in 5.4pt;height:15pt">
                                                                <p class="MsoNormal" align="center"
                                                                   style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                                    <span
                                                                        style="color:black">{{count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
                                                                </p>
                                                            </td>
                                                            <td width="84" nowrap=""
                                                                style="background-color: {{$team -> desc}};width:63.25pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;padding:0in 5.4pt;height:15pt">
                                                                <p class="MsoNormal" align="center"
                                                                   style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                                    <span
                                                                        style="color:black">{{count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
                                                                </p>
                                                            </td>
                                                            <td width="82" nowrap=""
                                                                style="background-color: {{$team -> desc}};width:61.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;padding:0in 5.4pt;height:15pt">
                                                                <p class="MsoNormal" align="center"
                                                                   style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                                    <span
                                                                        style="color:black">{{count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
                                                                </p>
                                                            </td>
                                                            <td width="82" nowrap=""
                                                                style="background-color: {{$team -> desc}};width:61.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;padding:0in 5.4pt;height:15pt">
                                                                <p class="MsoNormal" align="center"
                                                                   style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                                    <span
                                                                        style="color:black">{{count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
                                                                </p>
                                                            </td>
                                                            <td width="92" nowrap=""
                                                                style="background-color: {{$team -> desc}};width:68.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;padding:0in 5.4pt;height:15pt">
                                                                <p class="MsoNormal" align="center"
                                                                   style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                                    <span
                                                                        style="color:black">{{count(\App\Models\Task::where('team', $team -> id) -> where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>

                                            <!--       End Table Summary-->

                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><b>&nbsp;</b></span></font></div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            size="4"><span style="font-size:14pt;"><b>&nbsp;</b></span></font></span></font>
                                            </div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            size="4"><span style="font-size:14pt;color: black"><b>Details of the assignment:</b></span></font></span></font>
                                            </div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            color="black">&nbsp;</font></span></font></div>
                                            @foreach ($teams as $team)
                                                @if(
    count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0
    || count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0
    || count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0
    || count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0
    || count(\App\Models\Task::where('team', $team -> id) -> where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0  )

                                                    <div
                                                        style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                                style="font-size:11pt;"><font size="4"
                                                                                              color="#0070C0"><span
                                                                        style="font-size:14pt;"><b>{{$team -> name}}</b></span></font></span></font>
                                                    </div>
                                                    @if(count(\App\Models\Task::where('team', $team -> id)  -> where('type', 2) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0 || count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0)
                                                        <div>
                                                            <div style="text-indent:14pt;margin:0;"><font
                                                                    face="Calibri,sans-serif" size="2"><span
                                                                        style="font-size:11pt;"><font size="4"
                                                                                                      color="black"><span
                                                                                style="font-size:14pt;"><b>Testing requests</b></span></font></span></font>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0)
                                                        <div>
                                                            <div style="text-indent:22pt;margin:0;"><font
                                                                    face="Calibri,sans-serif" size="2"><span
                                                                        style="font-size:11pt;"><font
                                                                            color="black"><b>Done</b></font></span></font>
                                                            </div>
                                                            @foreach(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $done)
                                                                <div
                                                                    style="text-indent:33pt;margin:0;"><font
                                                                        face="Calibri,sans-serif" size="2"><span
                                                                            style="font-size:11pt;color: black"><a
                                                                                href="{{$board_config -> jira_url}}{{$done -> jira_id}}"
                                                                                target="_blank"
                                                                                rel="noopener noreferrer">{{$done -> jira_id}}</a><font
                                                                                color="black"> - {{$done -> jira_summary}} - <b>{{strtoupper(\App\Models\TicketStatus::find($done -> ticket_status) -> name)}} @if($done -> link_to_result)
                                                                                        - @endif</b> @if($done -> link_to_result)
                                                                                    <b><a
                                                                                            href="{{url($done -> link_to_result)}}"
                                                                                            target="_blank"
                                                                                            rel="noopener noreferrer">Link to result</a></b> @endif</font></span></font>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if(count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0)
                                                        <div
                                                            style="text-indent:22pt;margin:0;"><font
                                                                face="Calibri,sans-serif" size="2"><span
                                                                    style="font-size:11pt;"><font
                                                                        color="black"><b>In-progress</b></font></span></font>
                                                        </div>
                                                        @foreach(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $inprogres)
                                                            <div
                                                                style="text-indent:33pt;margin:0;"><font
                                                                    face="Calibri,sans-serif"
                                                                    size="2"><span
                                                                        style="font-size:11pt;color: black"><a
                                                                            href="{{$board_config -> jira_url}}{{$inprogres -> jira_id}}"
                                                                            target="_blank"
                                                                            rel="noopener noreferrer">{{$inprogres -> jira_id}} </a><font
                                                                            color="black">
                 - {{$inprogres -> jira_summary}} - <b>{{strtoupper(\App\Models\TicketStatus::find($inprogres -> ticket_status) -> name)}}</b> @if($inprogres -> link_to_result)
                                                                                - @endif</b> @if($inprogres -> link_to_result)
                                                                                    <b><a
                                                                                            href="{{url($inprogres -> link_to_result)}}"
                                                                                            target="_blank"
                                                                                            rel="noopener noreferrer">Link to result</a></b> @endif</font></span></font>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    <div
                                                        style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                                style="font-size:11pt;"><font size="4"
                                                                                              color="#0070C0"></font></span></font>
                                                    </div>
                                                    @if(count(\App\Models\Task::where('team', $team -> id)  -> where('type', 3) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0 || count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0)
                                                        <div>
                                                            <div style="text-indent:14pt;margin:0;"><font
                                                                    face="Calibri,sans-serif" size="2"><span
                                                                        style="font-size:11pt;"><font size="4"
                                                                                                      color="black"><span
                                                                                style="font-size:14pt;"><b>Tickets verification</b></span></font></span></font>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0)
                                                        <div>
                                                            <div style="text-indent:22pt;margin:0;"><font
                                                                    face="Calibri,sans-serif" size="2"><span
                                                                        style="font-size:11pt;"><font
                                                                            color="black"><b>Done</b></font></span></font>
                                                            </div>
                                                            @foreach(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $done)
                                                                <div
                                                                    style="text-indent:33pt;margin:0;"><font
                                                                        face="Calibri,sans-serif" size="2"><span
                                                                            style="font-size:11pt;color: black"><a
                                                                                href="{{$board_config -> jira_url}}{{$done -> jira_id}}"
                                                                                target="_blank"
                                                                                rel="noopener noreferrer">{{$done -> jira_id}}</a><font
                                                                                color="black"> - {{$done -> jira_summary}} - <b>{{strtoupper(\App\Models\TicketStatus::find($done -> ticket_status) -> name)}}</b> @if($done -> link_to_result)
                                                                                    - @endif</b> @if($done -> link_to_result)
                                                                                        <b><a
                                                                                                href="{{url($done -> link_to_result)}}"
                                                                                                target="_blank"
                                                                                                rel="noopener noreferrer">Link to result</a></b> @endif</font></span></font>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if(count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0)
                                                        <div
                                                            style="text-indent:22pt;margin:0;"><font
                                                                face="Calibri,sans-serif" size="2"><span
                                                                    style="font-size:11pt;color: black"><font
                                                                        color="black"><b>In-progress</b></font></span></font>
                                                        </div>
                                                        @foreach(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $inprogres)
                                                            <div
                                                                style="text-indent:33pt;margin:0;"><font
                                                                    face="Calibri,sans-serif"
                                                                    size="2"><span
                                                                        style="font-size:11pt;color: black"><a
                                                                            href="{{$board_config -> jira_url}}{{$inprogres -> jira_id}}"
                                                                            target="_blank"
                                                                            rel="noopener noreferrer">{{$inprogres -> jira_id}}</a><font
                                                                            color="black">
                 - {{$inprogres -> jira_summary}} - <b>{{strtoupper(\App\Models\TicketStatus::find($inprogres -> ticket_status) -> name)}}</b> @if($inprogres -> link_to_result)
                                                                                - @endif</b> @if($inprogres -> link_to_result)
                                                                                    <b><a
                                                                                            href="{{url($inprogres -> link_to_result)}}"
                                                                                            target="_blank"
                                                                                            rel="noopener noreferrer">Link to result</a></b> @endif</font></span></font>
                                                            </div>
                                                        @endforeach
                                                    @endif


                                                    @if(count(\App\Models\Task::where('team', $team -> id) -> where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0)
                                                        <div>
                                                            <div style="text-indent:14pt;margin:0;"><font
                                                                    face="Calibri,sans-serif" size="2"><span
                                                                        style="font-size:11pt;color: black"><font
                                                                            size="4"
                                                                            color="black"><span
                                                                                style="font-size:14pt;"><b>Bugs reported</b></span></font></span></font>
                                                            </div>
                                                            @foreach(\App\Models\Task::where('team', $team -> id) -> where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $bug_found)
                                                                <div
                                                                    style="text-indent:33pt;margin:0;"><font
                                                                        face="Calibri,sans-serif" size="2"><span
                                                                            style="font-size:11pt;color: black"><a
                                                                                href="{{$board_config -> jira_url}}{{$bug_found -> jira_id}}"
                                                                                target="_blank"
                                                                                rel="noopener noreferrer">{{$bug_found -> jira_id}}</a><font
                                                                                color="black">
       - {{$bug_found -> jira_summary}}</font></span></font></div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    <div
                                                        style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                                style="font-size:11pt;"><font
                                                                    color="black">&nbsp;</font></span></font></div>
                                                @endif

                                            @endforeach
                                            <div style="margin:0;"><font face="Calibri,sans-serif"
                                                                         size="2"><span
                                                        style="font-size:11pt;color: black">Thank you and best regards,</span></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($board -> id == 5)
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <div class="row">
                                            <h4>
                                                {{$final_subject }}
                                                <a href="{{url('mailto:?subject='.$final_subject.'&cc='.$report_config -> cc)}}"
                                                   class="ml-3 btn btn-primary float-end"><i
                                                        class="bi bi-cloud-arrow-up"></i> Open Outlook</a>
                                                <button class="ml-3 btn btn-info float-end" onclick="copyFunction()"><i
                                                        class="bi bi-copy"></i> Copy
                                                </button>
                                            </h4>
                                        </div>
                                        <div class="row">
                                            <b>CC List:</b> <br>{{$report_config -> cc}}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="divExp" class="divExp">
                                            <div class="card-body">
                                                <div id="divExp" class="bdyItmPrt" _fallwcm="1">
                                                    <div>
                                                        <div>
                                                            <div>
                                                                <div style="margin:0;"><font
                                                                        face="Times New Roman,serif" size="3"><span
                                                                            style="font-size:12pt;"><font
                                                                                face="Tahoma,sans-serif" size="2"
                                                                                color="black"><span
                                                                                    style="font-size:10pt;">Hi Sri and Chris,</span></font></span></font>
                                                                </div>
                                                                <!--        <div style="margin:0;"><font face="Times New Roman,serif" size="3"><span style="font-size:12pt;"><font-->
                                                                <!--          face="Tahoma,sans-serif" color="black">&nbsp;</font></span></font></div>-->
                                                                <div style="margin:0;"><font
                                                                        face="Times New Roman,serif" size="3"><span
                                                                            style="font-size:12pt;"><font
                                                                                face="Tahoma,sans-serif" size="2"
                                                                                color="black"><span
                                                                                    style="font-size:10pt;">Below is the status report for today. Please let me know if you have any comments/questions.</span></font></span></font>
                                                                </div>


                                                                <table width="1113" border="0" cellspacing="0"
                                                                       cellpadding="0"
                                                                       style="border-collapse:collapse;width:668pt;">
                                                                    <tbody>
                                                                    <tr height="86" style="height:51.75pt;">
                                                                        <td colspan="10" width="1113"
                                                                            style="width:668pt;height:51.75pt;padding:0 5.4pt;">
                                                                            <div align="center"
                                                                                 style="text-align:center;margin:0;">
                                                                                <font face="Calibri,sans-serif"
                                                                                      size="2"><span
                                                                                        style="font-size:11pt;"><font
                                                                                            size="6" color="black"><span
                                                                                                style="font-size:26pt;"><b>{{$final_subject}}</b></span></font></span></font>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr height="30" style="height:18pt;">
                                                                        <td colspan="10" width="1113" valign="bottom"
                                                                            nowrap=""
                                                                            style="width:668pt;height:18pt;padding:0 5.4pt;">
                                                                        </td>
                                                                    </tr>
                                                                    <tr height="30" style="height:18pt;">
                                                                        <td width="43"
                                                                            style="width:26pt;height:18pt;padding:0 5.4pt;">
                                                                            <div align="center"
                                                                                 style="text-align:center;margin:0;">
                                                                                <font face="Calibri,sans-serif"
                                                                                      size="2"><span
                                                                                        style="font-size:11pt;"><font
                                                                                            size="4" color="black"><span
                                                                                                style="font-size:14pt;"><b>I</b></span></font></span></font>
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="9" width="1070"
                                                                            style="width:642pt;height:18pt;padding:0 5.4pt;">
                                                                            <div style="margin:0;"><font
                                                                                    face="Calibri,sans-serif"
                                                                                    size="2"><span
                                                                                        style="font-size:11pt;"><font
                                                                                            size="4"
                                                                                            color="black"><span
                                                                                                style="font-size:14pt;"><b>TODAY'S ACCOMPLISHMENTS</b></span></font></span></font>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    @foreach(\App\Models\Task::where('board_id', 5) -> where('isSubBug', '0') -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $key=> $item)

                                                                        <tr height="30" style="height:18pt;">
                                                                            <td width="43" nowrap=""
                                                                                style="width:26pt;height:18pt;padding:0 5.4pt;">
                                                                                <div align="center"
                                                                                     style="text-align:center;margin:0;">
                                                                                    <font face="Calibri,sans-serif"
                                                                                          size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black"><b>{{$key + 1 }}</b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="8" width="941" nowrap=""
                                                                                style="width:565pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black"><b>{{$item -> jira_summary}}</b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="128"
                                                                                style="width:77pt;height:18pt;padding:0 5.4pt;">
                                                                                @if(\App\Models\WorkingStatus::find($item -> working_status)!=null)
                                                                                    <div style="margin:0;"><font
                                                                                            face="Calibri,sans-serif"
                                                                                            size="2"><span
                                                                                                style="font-size:11pt;"><font
                                                                                                    face="Tahoma,sans-serif"
                                                                                                    size="2"
                                                                                                    color="{{\App\Models\WorkingStatus::find($item -> working_status) -> desc}}"><span
                                                                                                        style="font-size:10pt;"><b>{{\App\Models\WorkingStatus::find($item -> working_status) -> name}}</b></span></font></span></font>
                                                                                    </div>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="30" style="height:18pt;">
                                                                            <td width="43" nowrap=""
                                                                                style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                            <td width="105"
                                                                                style="width:63pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black">Jira Story:</font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="7" width="836"
                                                                                style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><a
                                                                                                href="{{$board_config -> jira_url}}{{$item -> jira_id}}"
                                                                                                target="_blank"
                                                                                                rel="noopener noreferrer">{{$item -> jira_id}}</a></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="128"
                                                                                style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                        </tr>
                                                                        <tr height="30" style="height:18pt;">
                                                                            <td width="43" nowrap=""
                                                                                style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                            <td width="105"
                                                                                style="width:63pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black">Test Plan:</font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="7" width="836"
                                                                                style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><a
                                                                                                href="{{url('https://sonos.testrail.com/index.php?/plans/view/'.$item -> test_plan)}}"
                                                                                                target="_blank"
                                                                                                rel="noopener noreferrer">{{$item -> test_plan}}</a></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="128"
                                                                                style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                        </tr>
                                                                        <tr height="30" style="height:18pt;">
                                                                            <td width="43" nowrap=""
                                                                                style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                            <td width="105"
                                                                                style="width:63pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black">Executed:</font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="145"
                                                                                style="width:87pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black"><b>Total:</b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="50"
                                                                                style="width:30pt;height:18pt;padding:0 5.4pt;">
                                                                                <div align="center"
                                                                                     style="text-align:center;margin:0;">
                                                                                    <font face="Calibri,sans-serif"
                                                                                          size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black"><b>{{ $item->fail + $item->pass }}</b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="128"
                                                                                style="width:77pt;height:18pt;padding:0 5.4pt;">
                                                                                <div align="center"
                                                                                     style="text-align:center;margin:0;">
                                                                                    <font face="Calibri,sans-serif"
                                                                                          size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black">test cases</font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="5" width="641" valign="bottom"
                                                                                style="width:385pt;height:18pt;padding:0 5.4pt;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="30" style="height:18pt;">
                                                                            <td width="43" nowrap=""
                                                                                style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                            <td width="105"
                                                                                style="width:63pt;height:18pt;padding:0 5.4pt;"></td>
                                                                            <td width="145"
                                                                                style="width:87pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="#34A853"><b>Passed: </b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="50"
                                                                                style="width:30pt;height:18pt;padding:0 5.4pt;">
                                                                                <div align="center"
                                                                                     style="text-align:center;margin:0;">
                                                                                    <font face="Calibri,sans-serif"
                                                                                          size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black"><b>{{$item->pass}}</b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="128"
                                                                                style="width:77pt;height:18pt;padding:0 5.4pt;">
                                                                                <div align="center"
                                                                                     style="text-align:center;margin:0;">
                                                                                    <font face="Calibri,sans-serif"
                                                                                          size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black">test cases</font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="5" width="641" valign="bottom"
                                                                                style="width:385pt;height:18pt;padding:0 5.4pt;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="30" style="height:18pt;">
                                                                            <td width="43" nowrap=""
                                                                                style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                            <td width="105"
                                                                                style="width:63pt;height:18pt;padding:0 5.4pt;"></td>
                                                                            <td width="145"
                                                                                style="width:87pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="red"><b>Failed:</b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="50"
                                                                                style="width:30pt;height:18pt;padding:0 5.4pt;">
                                                                                <div align="center"
                                                                                     style="text-align:center;margin:0;">
                                                                                    <font face="Calibri,sans-serif"
                                                                                          size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black"><b>{{$item->fail}}</b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="128"
                                                                                style="width:77pt;height:18pt;padding:0 5.4pt;">
                                                                                <div align="center"
                                                                                     style="text-align:center;margin:0;">
                                                                                    <font face="Calibri,sans-serif"
                                                                                          size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black">test cases</font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="5" width="641" valign="bottom"
                                                                                style="width:385pt;height:18pt;padding:0 5.4pt;">
                                                                            </td>
                                                                            @if(count(\App\Models\Task::where('parent_task_id', $item -> id) ->latest()->get())!=0)
                                                                        </tr>
                                                                        <tr height="30" style="height:18pt;">
                                                                            <td width="43"
                                                                                style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                            <td width="105"
                                                                                style="width:63pt;height:18pt;padding:0 5.4pt;vertical-align: top">

                                                                                <div *ngIf="i ===0" style="margin:0;">
                                                                                    <font face="Calibri,sans-serif"
                                                                                          size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black">Bug(s): {{count(\App\Models\Task::where('parent_task_id', $item -> id) ->latest()->get())}}</font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="7" width="836"
                                                                                style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                                @foreach(\App\Models\Task::where('parent_task_id', $item -> id) ->latest()->get()  as $key => $row)
                                                                                    <div style="margin:0;"><font
                                                                                            face="Calibri,sans-serif"
                                                                                            size="2"><span
                                                                                                style="font-size:11pt;"><font
                                                                                                    color="black"><a
                                                                                                        href="{{$board_config -> jira_url}}{{$row -> jira_id}}"
                                                                                                        target="_blank">{{$row -> jira_id}}</a> - {{$row -> jira_summary}}</font></span></font>
                                                                                    </div>
                                                                                @endforeach

                                                                            </td>
                                                                            <td width="128"
                                                                                style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                        </tr>
                                                                        @endif
                                                                    @endforeach
                                                                    <tr height="30" style="height:18pt;">
                                                                    <tr height="30" style="height:18pt;">

                                                                        <td width="43"
                                                                            style="width:26pt;height:18pt;padding:0 5.4pt;">
                                                                            <div align="center"
                                                                                 style="text-align:center;margin:0;">
                                                                                <font face="Calibri,sans-serif"
                                                                                      size="2"><span
                                                                                        style="font-size:11pt;"><font
                                                                                            size="4" color="black"><span
                                                                                                style="font-size:14pt;"><b>II</b></span></font></span></font>
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="9" width="1070"
                                                                            style="width:642pt;height:18pt;padding:0 5.4pt;">
                                                                            <div style="margin:0;"><font
                                                                                    face="Calibri,sans-serif"
                                                                                    size="2"><span
                                                                                        style="font-size:11pt;"><font
                                                                                            size="4"
                                                                                            color="black"><span
                                                                                                style="font-size:14pt;"><b>TEST ENVIRONMENTS</b></span></font></span></font>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    @foreach(\App\Models\Task::where('board_id', 5) -> where('isSubBug', '0') -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $key=> $task)
                                                                        <tr height="30" style="height:18pt;">
                                                                            <td width="43" nowrap=""
                                                                                style="width:26pt;height:18pt;padding:0 5.4pt;">
                                                                                <div align="center"
                                                                                     style="text-align:center;margin:0;">
                                                                                    <font face="Calibri,sans-serif"
                                                                                          size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black"><b>{{$key + 1 }}</b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="8" width="941" nowrap=""
                                                                                style="width:565pt;height:18pt;padding:0 5.4pt;">
                                                                                <div style="margin:0;"><font
                                                                                        face="Calibri,sans-serif"
                                                                                        size="2"><span
                                                                                            style="font-size:11pt;"><font
                                                                                                color="black"><b>{{$task -> jira_summary}}</b></font></span></font>
                                                                                </div>
                                                                            </td>
                                                                            <td width="128"
                                                                                style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                        </tr>
                                                                        @if($task-> environment !=null)
                                                                            @if(\App\Models\Environment::find($task-> environment) -> email !=null)
                                                                                <tr height="30" style="height:18pt;">
                                                                                    <td width="43"
                                                                                        style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                    <td width="105"
                                                                                        style="width:63pt;height:18pt;padding:0 5.4pt;vertical-align: top">
                                                                                        <div *ngIf="i ===0"
                                                                                             style="margin:0;"><font
                                                                                                face="Calibri,sans-serif"
                                                                                                size="2"><span
                                                                                                    style="font-size:11pt;"><font
                                                                                                        color="black">Email/SonosID:</font></span></font>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td colspan="7" width="836"
                                                                                        style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                                        @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> email) as $row)
                                                                                            <div style="margin:0;"><font
                                                                                                    face="Calibri,sans-serif"
                                                                                                    size="2"><span
                                                                                                        style="font-size:11pt;"><font
                                                                                                            color="black">{{$row}}</font></span></font>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td width="128"
                                                                                        style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                </tr>
                                                                            @endif

                                                                            @if(\App\Models\Environment::find($task-> environment) -> browser !=null)
                                                                                <tr height="30" style="height:18pt;">
                                                                                    <td width="43"
                                                                                        style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                    <td width="105"
                                                                                        style="width:63pt;height:18pt;padding:0 5.4pt;vertical-align: top">
                                                                                        <div *ngIf="i ===0"
                                                                                             style="margin:0;"><font
                                                                                                face="Calibri,sans-serif"
                                                                                                size="2"><span
                                                                                                    style="font-size:11pt;"><font
                                                                                                        color="black">Browser:</font></span></font>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td colspan="7" width="836"
                                                                                        style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                                        @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> browser) as $row)
                                                                                            <div style="margin:0;"><font
                                                                                                    face="Calibri,sans-serif"
                                                                                                    size="2"><span
                                                                                                        style="font-size:11pt;"><font
                                                                                                            color="black">{{$row}}</font></span></font>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td width="128"
                                                                                        style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                </tr>
                                                                            @endif

                                                                            @if(\App\Models\Environment::find($task-> environment) -> player !=null)
                                                                                <tr height="30" style="height:18pt;">
                                                                                    <td width="43"
                                                                                        style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                    <td width="105"
                                                                                        style="width:63pt;height:18pt;padding:0 5.4pt;vertical-align: top">
                                                                                        <div *ngIf="i ===0"
                                                                                             style="margin:0;"><font
                                                                                                face="Calibri,sans-serif"
                                                                                                size="2"><span
                                                                                                    style="font-size:11pt;"><font
                                                                                                        color="black">Player:</font></span></font>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td colspan="7" width="836"
                                                                                        style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                                        @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> player) as $row)
                                                                                            <div style="margin:0;"><font
                                                                                                    face="Calibri,sans-serif"
                                                                                                    size="2"><span
                                                                                                        style="font-size:11pt;"><font
                                                                                                            color="black">{{$row}}</font></span></font>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td width="128"
                                                                                        style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                </tr>
                                                                            @endif

                                                                            @if(\App\Models\Environment::find($task-> environment) -> drop_date !=null)
                                                                                <tr height="30" style="height:18pt;">
                                                                                    <td width="43"
                                                                                        style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                    <td width="105"
                                                                                        style="width:63pt;height:18pt;padding:0 5.4pt;vertical-align: top">
                                                                                        <div *ngIf="i ===0"
                                                                                             style="margin:0;"><font
                                                                                                face="Calibri,sans-serif"
                                                                                                size="2"><span
                                                                                                    style="font-size:11pt;"><font
                                                                                                        color="black">Drop Date:</font></span></font>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td colspan="7" width="836"
                                                                                        style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                                        @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> drop_date) as $row)
                                                                                            <div style="margin:0;"><font
                                                                                                    face="Calibri,sans-serif"
                                                                                                    size="2"><span
                                                                                                        style="font-size:11pt;"><font
                                                                                                            color="black">{{$row}}</font></span></font>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td width="128"
                                                                                        style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                </tr>
                                                                            @endif

                                                                            @if(\App\Models\Environment::find($task-> environment) -> build !=null)
                                                                                <tr height="30" style="height:18pt;">
                                                                                    <td width="43"
                                                                                        style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                    <td width="105"
                                                                                        style="width:63pt;height:18pt;padding:0 5.4pt;vertical-align: top">
                                                                                        <div *ngIf="i ===0"
                                                                                             style="margin:0;"><font
                                                                                                face="Calibri,sans-serif"
                                                                                                size="2"><span
                                                                                                    style="font-size:11pt;"><font
                                                                                                        color="black">Build:</font></span></font>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td colspan="7" width="836"
                                                                                        style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                                        @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> build) as $row)
                                                                                            <div style="margin:0;"><font
                                                                                                    face="Calibri,sans-serif"
                                                                                                    size="2"><span
                                                                                                        style="font-size:11pt;"><font
                                                                                                            color="black">{{$row}}</font></span></font>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td width="128"
                                                                                        style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                </tr>
                                                                            @endif

                                                                            @if(\App\Models\Environment::find($task-> environment) -> device !=null)
                                                                                <tr height="30" style="height:18pt;">
                                                                                    <td width="43"
                                                                                        style="width:26pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                    <td width="105"
                                                                                        style="width:63pt;height:18pt;padding:0 5.4pt;vertical-align: top">
                                                                                        <div style="margin:0;"><font
                                                                                                face="Calibri,sans-serif"
                                                                                                size="2"><span
                                                                                                    style="font-size:11pt;"><font
                                                                                                        color="black">Device:</font></span></font>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td colspan="7" width="836"
                                                                                        style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                                        @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> device) as $row)
                                                                                            <div style="margin:0;"><font
                                                                                                    face="Calibri,sans-serif"
                                                                                                    size="2"><span
                                                                                                        style="font-size:11pt;"><font
                                                                                                            color="black">{{$row}}</font></span></font>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td width="128"
                                                                                        style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                                </tr>
                                                                            @endif
                                                                        @endif

                                                                    @endforeach
                                                                    <tr height="30" style="height:18pt;"></tr>
                                                                    <tr height="30" style="height:18pt;">
                                                                        <td width="43"
                                                                            style="width:26pt;height:18pt;padding:0 5.4pt;">
                                                                            <div align="center"
                                                                                 style="text-align:center;margin:0;">
                                                                                <font face="Calibri,sans-serif"
                                                                                      size="2"><span
                                                                                        style="font-size:11pt;"><font
                                                                                            size="4" color="black"><span
                                                                                                style="font-size:14pt;"><b>III</b></span></font></span></font>
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="9" width="1070"
                                                                            style="width:642pt;height:18pt;padding:0 5.4pt;">
                                                                            <div style="margin:0;"><font
                                                                                    face="Calibri,sans-serif"
                                                                                    size="2"><span
                                                                                        style="font-size:11pt;"><font
                                                                                            size="4"
                                                                                            color="black"><span
                                                                                                style="font-size:14pt;"><b>TO DO NEXT</b></span></font></span></font>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr height="30" style="height:18pt;">
                                                                        <td width="43" valign="bottom" nowrap=""
                                                                            style="width:26pt;height:18pt;padding:0 5.4pt;">
                                                                        </td>
                                                                        <td width="105"
                                                                            style="width:63pt;height:18pt;padding:0 5.4pt;">
                                                                            <div style="margin:0;"><font
                                                                                    face="Calibri,sans-serif"
                                                                                    size="2"><span
                                                                                        style="font-size:11pt;"><font
                                                                                            color="black">Continue </font></span></font>
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="7" width="836"
                                                                            style="width:502pt;height:18pt;padding:0 5.4pt;">
                                                                            <div style="margin:0;"><font
                                                                                    face="Calibri,sans-serif"
                                                                                    size="2"><span
                                                                                        style="font-size:11pt;"><font
                                                                                            color="black"><b>TBD</b></font></span></font>
                                                                            </div>
                                                                        </td>
                                                                        <td width="128"
                                                                            style="width:77pt;height:18pt;padding:0 5.4pt;"></td>
                                                                    </tr>
                                                                    <tr height="30" style="height:18pt;">
                                                                        <td colspan="10" width="1113" valign="bottom"
                                                                            nowrap=""
                                                                            style="width:668pt;height:18pt;padding:0 5.4pt;">
                                                                        </td>
                                                                    </tr>
                                                                    <tr height="30" style="height:18pt;">
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($board -> id == 1)
                        <div class="tab-pane fade" id="slack_report" role="tabpanel">
                            <div>
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h5>Slack Report Type</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($board -> id == 1)
                                                <div class="p-rich_text_block" dir="auto">
                                                    @foreach ($teams as $team)
                                                        @if(
            count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) !=0
            || count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0
            || count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0
            || count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0
            || count(\App\Models\Task::where('team', $team -> id) -> where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get()) != 0 )
                                                            <div class="card-body">
                                                                <div id=":pw" class="a3s aiL ">
                                                                    <div dir="ltr" id="divExp">
                                                                        <div
                                                                            style="margin:0;"><font
                                                                                face="Calibri,sans-serif"
                                                                                size="2"><span
                                                                                    style="font-size:11pt;"><font
                                                                                        size="4"
                                                                                        color="#0070C0"><span
                                                                                            style="font-size:14pt;"><b>{{$team -> name}}</b></span></font></span></font>
                                                                        </div>
                                                                        <div
                                                                            style="box-sizing:inherit;color:rgb(29,28,29);font-family:Slack-Lato,Slack-Fractions,appleLogo,sans-serif;font-size:15px;font-variant-ligatures:common-ligatures;">
                                                                            {{$slack_subject}}
                                                                        </div>
                                                                        @if(count(\App\Models\Task::where('team', $team -> id) -> where('board_id', 1) -> where('type', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() )!=0)
                                                                            <div
                                                                                style="box-sizing:inherit;color:rgb(29,28,29);font-family:Slack-Lato,Slack-Fractions,appleLogo,sans-serif;font-size:15px;font-variant-ligatures:common-ligatures;">
                                                                                <b
                                                                                    style="box-sizing:inherit">Testing
                                                                                    requests</b>
                                                                            </div>
                                                                            <ul style="box-sizing:inherit;margin:0px;padding:0px;color:rgb(29,28,29);font-family:Slack-Lato,Slack-Fractions,appleLogo,sans-serif;font-size:15px;font-variant-ligatures:common-ligatures;">
                                                                                @foreach(\App\Models\Task::where('team', $team -> id) -> where('board_id', 1) -> where('type', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $item)

                                                                                    <li
                                                                                        style="box-sizing:inherit;margin-bottom:0px;margin-left:28px;">
                                                                                        <a
                                                                                            href="{{$board_config -> jira_url}}{{$item -> jira_id}}"
                                                                                            rel="noopener noreferrer"
                                                                                            style="box-sizing:inherit;text-decoration-line:none"
                                                                                            target="_blank">{{$item -> jira_id}}</a>&nbsp;-
                                                                                        {{$item -> jira_summary}}
                                                                                        -&nbsp;<b
                                                                                            style="box-sizing:inherit">{{strtoupper(\App\Models\TicketStatus::find($item -> ticket_status) -> name) }}
                                                                                            @if($item -> link_to_result != null && $item -> team == 22)
                                                                                                <span>- No new issue found</span>
                                                                                            @endif

                                                                                        </b>
                                                                                        @if($item -> link_to_result != null)
                                                                                            <b style="box-sizing:inherit">-&nbsp;<a
                                                                                                    href="{{$item -> link_to_result}}"
                                                                                                    rel="noopener noreferrer"
                                                                                                    style="box-sizing:inherit;text-decoration-line:none"
                                                                                                    target="_blank">Link
                                                                                                    to
                                                                                                    result</a></b>
                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                        @if(count(\App\Models\Task::where('team', $team -> id)-> where('board_id', 1) ->  where('type', 3) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() )!=0)
                                                                            <div
                                                                                style="box-sizing:inherit;color:rgb(29,28,29);font-family:Slack-Lato,Slack-Fractions,appleLogo,sans-serif;font-size:15px;font-variant-ligatures:common-ligatures;">
                                                                                <b style="box-sizing:inherit">Tickets
                                                                                    verification</b>
                                                                            </div>
                                                                            <ul style="box-sizing:inherit;margin:0px;padding:0px;color:rgb(29,28,29);font-family:Slack-Lato,Slack-Fractions,appleLogo,sans-serif;font-size:15px;font-variant-ligatures:common-ligatures;">
                                                                                @foreach(\App\Models\Task::where('team', $team -> id)-> where('board_id', 1) -> where('type', 3) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $item)
                                                                                    <li
                                                                                        style="box-sizing:inherit;margin-bottom:0px;margin-left:28px;">
                                                                                        <a
                                                                                            href="{{$board_config -> jira_url}}{{$item -> jira_id}}"
                                                                                            rel="noopener noreferrer"
                                                                                            style="box-sizing:inherit;text-decoration-line:none"
                                                                                            target="_blank">{{$item -> jira_id}}</a>-
                                                                                        {{$item -> jira_summary}}
                                                                                        -&nbsp;<b
                                                                                            style="box-sizing:inherit">{{strtoupper(\App\Models\TicketStatus::find($item -> ticket_status) -> name) }}
                                                                                            @if($item -> link_to_result != null && $item -> team == 22)
                                                                                                <span>&nbsp;- No new issue found&nbsp;</span>
                                                                                            @endif
                                                                                        </b>
                                                                                        @if($item -> link_to_result != null)
                                                                                            <b style="box-sizing:inherit">-&nbsp;<a
                                                                                                    href="{{$item -> link_to_result}}"
                                                                                                    rel="noopener noreferrer"
                                                                                                    style="box-sizing:inherit;text-decoration-line:none"
                                                                                                    target="_blank">Link
                                                                                                    to
                                                                                                    result</a></b>
                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                        @if(count(\App\Models\Task::where('team', $team -> id)-> where('board_id', 1) -> where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() )!=0)

                                                                            <div
                                                                                style="box-sizing:inherit;color:rgb(29,28,29);font-family:Slack-Lato,Slack-Fractions,appleLogo,sans-serif;font-size:15px;font-variant-ligatures:common-ligatures;">
                                                                                <b style="box-sizing:inherit">Bugs
                                                                                    Reported</b>
                                                                            </div>
                                                                            <ul style="box-sizing:inherit;margin:0px;padding:0px;color:rgb(29,28,29);font-family:Slack-Lato,Slack-Fractions,appleLogo,sans-serif;font-size:15px;font-variant-ligatures:common-ligatures;">
                                                                                @foreach(\App\Models\Task::where('team', $team -> id)-> where('board_id', 1) -> where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today()) -> orderBy('jira_id', 'ASC')->get() as $item)

                                                                                    <li
                                                                                        style="box-sizing:inherit;margin-bottom:0px;margin-left:28px;">
                                                                                        <a
                                                                                            href="{{$board_config -> jira_url}}{{$item -> jira_id}}"
                                                                                            rel="noopener noreferrer"
                                                                                            style="box-sizing:inherit;text-decoration-line:none"
                                                                                            target="_blank">{{$item -> jira_id}}</a>-
                                                                                        {{$item -> jira_summary}}
                                                                                        @if(\App\Models\TicketStatus::find($item -> ticket_status) -> id == 7)
                                                                                            -&nbsp;<b
                                                                                                style="box-sizing:inherit">{{strtoupper(\App\Models\TicketStatus::find($item -> ticket_status) -> name) }}
                                                                                            </b>
                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                        <div
                                                                            style="box-sizing:inherit;color:rgb(29,28,29);font-family:Slack-Lato,Slack-Fractions,appleLogo,sans-serif;font-size:15px;font-variant-ligatures:common-ligatures;">
                                                                    <span aria-label=""
                                                                          style="box-sizing:inherit;height:8px;display:block"></span>Thanks!
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($board -> id == 5)
                        <div class="tab-pane fade" id="sprint_report" role="tabpanel">
                            <div>
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h5>Sprint Report</h5>
                                            <div class="col-6">
                                                <form id="myForm" action="{{ route('manager.sprint.report') }}"
                                                      method="get" class="row g-3">
                                                    <input name="sprint" type="text" class="form-control"
                                                           placeholder="Enter Sprint">
                                                    <input type="hidden" name="board_id" value="{{$board -> id}}">
                                                    <div class="col-sm-9">
                                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                                            <button type="submit" class="btn btn-primary px-5"><i
                                                                    class='bx bx-add-to-queue mr-1'></i>Generate
                                                            </button>
                                                            <button type="reset" class="btn btn-outline-secondary px-5">
                                                                <i
                                                                    class='bx bx-reset mr-1'></i>Reset
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="tab-pane fade" id="reportconfig" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" action="{{ route('manager.save-report-config') }}"
                                      method="post"
                                      class="row g-3"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <h5 class="mb-4">Report Config</h5>
                                        <input type="hidden" name="board_id"
                                               value="{{$board -> id}}">
                                        <div class="row mb-3">
                                            <label for="project_name"
                                                   class="col-sm-3 col-form-label">Board
                                                Name</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" disabled
                                                           value="{{$board ->name}}"
                                                           id="board_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="subject"
                                                   class="col-sm-3 col-form-label">Subject</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                               name="subject" id="subject"
                                                               value="{{$report_config -> subject}}">
                                                    </div>
                                                </div>
                                                @error('subject')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="cc" class="col-sm-3 col-form-label">CC
                                                List</label>
                                            <div class="col-sm-9">
                                <textarea class="form-control" name="cc" id="cc" rows="5"
                                          placeholder="Enter the cc list ...">{{$report_config -> cc}}</textarea>
                                                @error('cc')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="date_format"
                                                   class="col-sm-3 col-form-label">Date
                                                Format</label>
                                            <div class="col-sm-9">

                                                <div class="col-sm-9">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                               name="date_format" id="date_format"
                                                               value="{{$report_config -> date_format}}">
                                                    </div>
                                                </div>
                                                @error('cc')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <div
                                                    class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit"
                                                            class="btn btn-primary px-5"><i
                                                            class='bx bx-add-to-queue mr-1'></i>Save
                                                        Report Config
                                                    </button>
                                                    <button type="reset"
                                                            class="btn btn-outline-secondary px-5">
                                                        <i
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
                    <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm"
                                      action="{{ route('manager.update-board-config') }}"
                                      method="post"
                                      class="row g-3"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <h5 class="mb-4">Board Config</h5>
                                        <input type="hidden" name="board_config_id"
                                               value="{{$board_config -> id}}">
                                        <div class="row mb-3">
                                            <label for="project_name"
                                                   class="col-sm-3 col-form-label">Board
                                                Name</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" disabled
                                                           value="{{$board ->name}}"
                                                           id="board_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="jira_url" class="col-sm-3 col-form-label">Jira
                                                URL</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                               value="{{$board_config ->jira_url}}"
                                                               name="jira_url" id="jira_url">
                                                    </div>
                                                </div>
                                                @error('jira_url')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Team</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> team == 1 ? 'checked': ''}} type="radio"
                                                           name="team" id="team1" value="1">
                                                    <label class="form-check-label"
                                                           for="team1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> team == 0 ? 'checked': ''}} type="radio"
                                                           name="team" id="team0" value="0">
                                                    <label class="form-check-label"
                                                           for="team0">Disable</label>
                                                </div>
                                                @error('team')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Type</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> type == 1 ? 'checked': ''}} type="radio"
                                                           name="type" id="type1" value="1">
                                                    <label class="form-check-label"
                                                           for="type1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> type == 0 ? 'checked': ''}} type="radio"
                                                           name="type" id="type0" value="0">
                                                    <label class="form-check-label"
                                                           for="type0">Disable</label>
                                                </div>
                                                @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Jira Id</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> jira_id == 1 ? 'checked': ''}} type="radio"
                                                           name="jira_id" id="jira_id1" value="1">
                                                    <label class="form-check-label"
                                                           for="jira_id1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> jira_id == 0 ? 'checked': ''}} type="radio"
                                                           name="jira_id" id="jira_id0" value="0">
                                                    <label class="form-check-label"
                                                           for="jira_id0">Disable</label>
                                                </div>
                                                @error('jira_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Jira
                                                Summary</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> jira_summary == 1 ? 'checked': ''}} type="radio"
                                                           name="jira_summary" id="jira_summary1"
                                                           value="1">
                                                    <label class="form-check-label"
                                                           for="jira_summary1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> jira_summary == 0 ? 'checked': ''}} type="radio"
                                                           name="jira_summary" id="jira_summary0"
                                                           value="0">
                                                    <label class="form-check-label"
                                                           for="jira_summary0">Disable</label>
                                                </div>
                                                @error('jira_summary')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Working
                                                Status</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> working_status == 1 ? 'checked': ''}} type="radio"
                                                           name="working_status"
                                                           id="working_status1" value="1">
                                                    <label class="form-check-label"
                                                           for="working_status1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> working_status == 0 ? 'checked': ''}} type="radio"
                                                           name="working_status"
                                                           id="working_status0" value="0">
                                                    <label class="form-check-label"
                                                           for="working_status0">Disable</label>
                                                </div>
                                                @error('working_status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Ticket
                                                Status</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> ticket_status == 1 ? 'checked': ''}} type="radio"
                                                           name="ticket_status" id="ticket_status1"
                                                           value="1">
                                                    <label class="form-check-label"
                                                           for="ticket_status1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> ticket_status == 0 ? 'checked': ''}} type="radio"
                                                           name="ticket_status" id="ticket_status0"
                                                           value="0">
                                                    <label class="form-check-label"
                                                           for="ticket_status0">Disable</label>
                                                </div>
                                                @error('ticket_status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Priority</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> priority == 1 ? 'checked': ''}} checked
                                                           type="radio" name="priority"
                                                           id="priority1" value="1">
                                                    <label class="form-check-label"
                                                           for="priority1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> priority == 0 ? 'checked': ''}} type="radio"
                                                           name="priority" id="priority0" value="0">
                                                    <label class="form-check-label"
                                                           for="priority0">Disable</label>
                                                </div>
                                                @error('priority')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Link To
                                                Result</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> link_to_result == 1 ? 'checked': ''}} type="radio"
                                                           name="link_to_result"
                                                           id="link_to_result1" value="1">
                                                    <label class="form-check-label"
                                                           for="link_to_result1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> link_to_result == 0 ? 'checked': ''}} type="radio"
                                                           name="link_to_result"
                                                           id="link_to_result0" value="0">
                                                    <label class="form-check-label"
                                                           for="link_to_result0">Disable</label>
                                                </div>
                                                @error('link_to_result')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Test Plan</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> test_plan == 1 ? 'checked': ''}} type="radio"
                                                           name="test_plan" id="test_plan1"
                                                           value="1">
                                                    <label class="form-check-label"
                                                           for="test_plan1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> test_plan == 0 ? 'checked': ''}} type="radio"
                                                           name="test_plan" id="test_plan0"
                                                           value="0">
                                                    <label class="form-check-label"
                                                           for="test_plan0">Disable</label>
                                                </div>
                                                @error('test_plan')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Sprint</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> sprint == 1 ? 'checked': ''}} type="radio"
                                                           name="sprint" id="sprint1" value="1">
                                                    <label class="form-check-label"
                                                           for="sprint1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> sprint == 0 ? 'checked': ''}} type="radio"
                                                           name="sprint" id="sprint0" value="0">
                                                    <label class="form-check-label"
                                                           for="sprint0">Disable</label>
                                                </div>
                                                @error('sprint')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Note</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> note == 1 ? 'checked': ''}} type="radio"
                                                           name="note" id="note1" value="1">
                                                    <label class="form-check-label"
                                                           for="note1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> note == 0 ? 'checked': ''}} type="radio"
                                                           name="note" id="note0" value="0">
                                                    <label class="form-check-label"
                                                           for="note0">Disable</label>
                                                </div>
                                                @error('note')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="col-sm-3 col-form-label">Environment</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> environment == 1 ? 'checked': ''}} type="radio"
                                                           name="environment" id="environment1"
                                                           value="1">
                                                    <label class="form-check-label"
                                                           for="environment1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> environment == 0 ? 'checked': ''}} type="radio"
                                                           name="environment" id="environment0"
                                                           value="0">
                                                    <label class="form-check-label"
                                                           for="environment0">Disable</label>
                                                </div>
                                                @error('environment')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Sub Bug</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> isSubBug == 1 ? 'checked': ''}} type="radio"
                                                           name="isSubBug" id="isSubBug1" value="1">
                                                    <label class="form-check-label"
                                                           for="isSubBug1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> isSubBug == 0 ? 'checked': ''}} type="radio"
                                                           name="isSubBug" id="isSubBug0" value="0">
                                                    <label class="form-check-label"
                                                           for="isSubBug0">Disable</label>
                                                </div>
                                                @error('environment')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Tester 1</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_1 == 1 ? 'checked': ''}} type="radio"
                                                           name="tester_1" id="tester_11" value="1">
                                                    <label class="form-check-label"
                                                           for="tester_11">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_1 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_1" id="tester_10" value="0">
                                                    <label class="form-check-label"
                                                           for="tester_10">Disable</label>
                                                </div>
                                                @error('tester_1')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Tester 2</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_2 == 1 ? 'checked': ''}} type="radio"
                                                           name="tester_2" id="tester_21" value="1">
                                                    <label class="form-check-label"
                                                           for="tester_21">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_2 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_2" id="tester_20" value="0">
                                                    <label class="form-check-label"
                                                           for="tester_20">Disable</label>
                                                </div>
                                                @error('tester_2')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Tester 3</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_3 == 1 ? 'checked': ''}} type="radio"
                                                           name="tester_3" id="tester_31" value="1">
                                                    <label class="form-check-label"
                                                           for="tester_31">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_3 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_3" id="tester_30" value="0">
                                                    <label class="form-check-label"
                                                           for="tester_30">Disable</label>
                                                </div>
                                                @error('tester_3')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Tester 4</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_4 == 1 ? 'checked': ''}} type="radio"
                                                           name="tester_4" id="tester_41" value="1">
                                                    <label class="form-check-label"
                                                           for="tester_41">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_4 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_4" id="tester_40" value="0">
                                                    <label class="form-check-label"
                                                           for="tester_40">Disable</label>
                                                </div>
                                                @error('tester_4')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Tester 5</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_5 == 1 ? 'checked': ''}} type="radio"
                                                           name="tester_5" id="tester_51" value="1">
                                                    <label class="form-check-label"
                                                           for="tester_51">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_5 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_5" id="tester_50" value="0">
                                                    <label class="form-check-label"
                                                           for="tester_50">Disable</label>
                                                </div>
                                                @error('tester_5')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Test Case
                                                Pass</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> pass == 1 ? 'checked': ''}} type="radio"
                                                           name="pass" id="pass1" value="1">
                                                    <label class="form-check-label"
                                                           for="pass1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> fail == 0 ? 'checked': ''}} type="radio"
                                                           name="pass" id="pass0" value="0">
                                                    <label class="form-check-label"
                                                           for="pass0">Disable</label>
                                                </div>
                                                @error('pass')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Test Case
                                                Fail</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> fail == 1 ? 'checked': ''}} type="radio"
                                                           name="fail" id="fail1" value="1">
                                                    <label class="form-check-label"
                                                           for="fail1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> fail == 0 ? 'checked': ''}} type="radio"
                                                           name="fail" id="fail0" value="0">
                                                    <label class="form-check-label"
                                                           for="fail0">Disable</label>
                                                </div>
                                                @error('fail')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <div
                                                    class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit"
                                                            class="btn btn-primary px-5"><i
                                                            class='bx bx-add-to-queue mr-1'></i>Save
                                                        Config
                                                    </button>
                                                    <button type="reset"
                                                            class="btn btn-outline-secondary px-5">
                                                        <i
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
                </div>
            </div>

        </div>
    </div>

    <script>
        function copyFunction() {
            const elm = document.getElementById("divExp");
            // for Internet Explorer

            if (document.body.createTextRange) {
                const range = document.body.createTextRange();
                range.moveToElementText(elm);
                range.select();
                document.execCommand("copy");
                alert("Copied div content to clipboard");
            } else if (window.getSelection) {
                // other browsers

                const selection = window.getSelection();
                const range = document.createRange();
                range.selectNodeContents(elm);
                selection.removeAllRanges();
                selection.addRange(range);
                document.execCommand("copy");
                alert("Copied div content to clipboard");
            }
        }
    </script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('.status-toggle').on('change', function () {--}}
{{--                var userId = $(this).data('user-id');--}}
{{--                var isChecked = $(this).is(':checked');--}}

{{--                // send an ajax request to update status--}}

{{--                $.ajax({--}}
{{--                    url: "{{ route('manager.update.user.status') }}",--}}
{{--                    method: "POST",--}}
{{--                    data: {--}}
{{--                        user_id: userId,--}}
{{--                        is_checked: isChecked ? 1 : 0,--}}
{{--                        _token: "{{ csrf_token() }}"--}}
{{--                    },--}}
{{--                    success: function (response) {--}}
{{--                        toastr.success(response.message);--}}
{{--                        window.setTimeout(function () {--}}
{{--                            location.reload();--}}
{{--                        }, 2000);--}}

{{--                    },--}}
{{--                    error: function () {--}}

{{--                    }--}}
{{--                });--}}

{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $("#submitbtn").click(function (event) {--}}
{{--            event.preventDefault();--}}
{{--            var data = $("#myForm").serialize();--}}
{{--            console.log(data);--}}
{{--            $.ajax({--}}
{{--                type: "post",--}}
{{--                url: "{{ route('manager.tasks.save') }}",--}}
{{--                data: data,--}}
{{--                success: function (data) {--}}
{{--                    toastr.success(response.message);--}}
{{--                },--}}
{{--                error: function (data) {--}}
{{--                    // Android.passParams(url);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        $('#type').change(function(e){
            if($(this).val() == "1"){
                $("#working_status option[value='1']").prop('disabled',true);
                $("#link_to_result").prop('disabled',true);
                $("#ticket_status option[value='1']").prop('disabled',true);
                $("#ticket_status option[value='2']").prop('disabled',true);
                $("#ticket_status option[value='3']").prop('disabled',true);
                $("#ticket_status option[value='4']").prop('disabled',true);
                $("#ticket_status option[value='5']").prop('disabled',true);
                $("#ticket_status option[value='6']").prop('disabled',true);
            }
            else {
                $("#working_status option[value='1']").prop('disabled',false);
                $("#ticket_status option[value='1']").prop('disabled',false);
                $("#ticket_status option[value='2']").prop('disabled',false);
                $("#ticket_status option[value='3']").prop('disabled',false);
                $("#ticket_status option[value='4']").prop('disabled',false);
                $("#ticket_status option[value='5']").prop('disabled',false);
                $("#ticket_status option[value='6']").prop('disabled',false);
                $("#link_to_result").prop('disabled',false);
            }
        });
    </script>
@endsection
