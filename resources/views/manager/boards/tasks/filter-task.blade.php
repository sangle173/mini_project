@extends('manager.manager_dashboard')
@section('users')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <body class="bg-light">
    <div class=" d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    {{--                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager.show.board', $board -> id)}}">{{$board -> name}} Board</a></li>--}}
                    <li class="breadcrumb-item active" aria-current="page">All Tasks</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container-fluid mt-5">
        <form method="GET" action="{{ route('tasks.filter', $board -> id) }}" class="row g-3 mb-4">
            <!-- Type Dropdown -->
            <div class="col-md-2">
                <select name="type" class="form-select">
                    <option value="">-- Select Type --</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ ($filters['type'] ?? '') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Team Dropdown -->
            <div class="col-md-2">
                <select name="team" class="form-select">
                    <option value="">-- Select Team --</option>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}" {{ ($filters['team'] ?? '') == $team->id ? 'selected' : '' }}>
                            {{ $team->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tester Dropdown -->
            <div class="col-md-2">
                <select name="tester" class="form-select">
                    <option value="">-- Select Tester --</option>
                    @foreach ($testers as $tester)
                        <option
                            value="{{ $tester->id }}" {{ ($filters['tester'] ?? '') == $tester->id ? 'selected' : '' }}>
                            {{ $tester->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date Picker -->
            <div class="col-md-2">
                <input type="date" name="date" class="form-control"
                       value="{{ $filters['date'] ?? now()->toDateString() }}">
            </div>

            <!-- Search Bar -->
            <div class="col-md-2">
                <input type="text" name="search" class="form-control" placeholder="Search JIRA ID/Summary"
                       value="{{ $filters['search'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div class="col-md-2 ms-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
                <!-- Reset Filters -->
                <a href="{{ route('tasks.filter', $board -> id) }}" class="btn btn-secondary">Reset Filters</a>
            </div>
        </form>


        <!-- Tasks Table -->
        @if($tasks->isEmpty())
            <div class="alert alert-warning">No tasks match the selected filters.</div>
        @else
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
                                <th>LinkToResult</th>
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
                                <td width="2%"><a href="{{ route('task.details',$item->id) }}"
                                                  title="View" class="text-black">{{ $key+1 }}</a></td>
                                @if($board_config-> type != 0)
                                    <td width="5%">
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
                                    <td width="7%">
                                        @if($item-> team !=null)
                                            {{\App\Models\Team::find($item-> team) -> name}}
                                        @endif
                                    </td>
                                @endif
                                @if($board_config-> jira_summary != 0)
                                    <td width="45%" title="{{$item->jira_summary}}">
                                        @if($item-> jira_summary !=null)
                                            <a href="{{url($board_config -> jira_url . $item-> jira_id) }}"
                                               target="_blank">{{ $item->jira_id }}</a>
                                            - {{ \Illuminate\Support\Str::limit($item->jira_summary, 100, $end=' ...') }}
                                        @endif
                                    </td>
                                @endif
                                @if($board_config-> working_status != 0)
                                    <td width="5%">
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
                                    <td width="5%">
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
                                    <td width="5%">
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
                                    <td width="10%">
                                        <div style="margin-left: 15px!important;"
                                             class="user-groups ms-auto">
                                            @if($item-> tester_1 !=null || $item-> tester_1 !=0 )
                                                <a href="{{route('manager.details.user', $item-> tester_1)}}">
                                                    <img
                                                        src="{{ (!empty(\App\Models\User::find($item -> tester_1)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_1)->photo) : url('upload/no_image.jpg')}}"
                                                        width="35" height="35" class="rounded-circle"
                                                        title="{{\App\Models\User::find($item -> tester_1)-> name}}"
                                                        alt=""/>
                                                </a>
                                            @endif
                                            @if($item-> tester_2 !=null || $item-> tester_2 !=0 )
                                                <a href="{{route('manager.details.user', $item-> tester_2)}}">
                                                    <img
                                                        src="{{ (!empty(\App\Models\User::find($item -> tester_2)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_2)->photo) : url('upload/no_image.jpg')}}"
                                                        width="35" height="35" class="rounded-circle"
                                                        title="{{\App\Models\User::find($item -> tester_2)-> name}}"
                                                        alt=""/>
                                                </a>
                                            @endif
                                            @if($item-> tester_3 !=null || $item-> tester_3 !=0 )
                                                <a href="{{route('manager.details.user', $item-> tester_3)}}">
                                                    <img
                                                        src="{{ (!empty(\App\Models\User::find($item -> tester_3)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_3)->photo) : url('upload/no_image.jpg')}}"
                                                        width="35" height="35" class="rounded-circle"
                                                        title="{{\App\Models\User::find($item -> tester_3)-> name}}"
                                                        alt=""/>
                                                </a>
                                            @endif
                                            @if($item-> tester_4 !=null || $item-> tester_4 !=0 )
                                                <a href="{{route('manager.details.user', $item-> tester_4)}}">
                                                    <img
                                                        src="{{ (!empty(\App\Models\User::find($item -> tester_4)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_4)->photo) : url('upload/no_image.jpg')}}"
                                                        width="35" height="35" class="rounded-circle"
                                                        title="{{\App\Models\User::find($item -> tester_4)-> name}}"
                                                        alt=""/>
                                                </a>
                                            @endif
                                            @if($item-> tester_5 !=null || $item-> tester_5 !=0 )
                                                <a href="{{route('manager.details.user', $item-> tester_5)}}">
                                                    <img
                                                        src="{{ (!empty(\App\Models\User::find($item -> tester_1)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> tester_5)->photo) : url('upload/no_image.jpg')}}"
                                                        width="35" height="35" class="rounded-circle"
                                                        title="{{\App\Models\User::find($item -> tester_5)-> name}}"
                                                        alt=""/>
                                                </a>
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
            {{--        <table class="table table-bordered table-striped">--}}
            {{--            <thead class="table-dark">--}}
            {{--            <tr>--}}
            {{--                <th>Type</th>--}}
            {{--                <th>Team</th>--}}
            {{--                <th>JIRA ID</th>--}}
            {{--                <th>JIRA Summary</th>--}}
            {{--                <th>Working Status</th>--}}
            {{--                <th>Ticket Status</th>--}}
            {{--                <th>Tester 1</th>--}}
            {{--                <th>Tester 2</th>--}}
            {{--                <th>Tester 3</th>--}}
            {{--                <th>Tester 4</th>--}}
            {{--                <th>Tester 5</th>--}}
            {{--            </tr>--}}
            {{--            </thead>--}}
            {{--            <tbody>--}}
            {{--            @foreach ($tasks as $task)--}}
            {{--                <tr>--}}
            {{--                    <td>{{ $task->type }}</td>--}}
            {{--                    <td>{{ $task->team }}</td>--}}
            {{--                    <td>{{ $task->jira_id }}</td>--}}
            {{--                    <td>{{ $task->jira_summary }}</td>--}}
            {{--                    <td>{{ $task->working_status }}</td>--}}
            {{--                    <td>{{ $task->ticket_status }}</td>--}}
            {{--                    <td>{{ $task->tester_1 }}</td>--}}
            {{--                    <td>{{ $task->tester_2 }}</td>--}}
            {{--                    <td>{{ $task->tester_3 }}</td>--}}
            {{--                    <td>{{ $task->tester_4 }}</td>--}}
            {{--                    <td>{{ $task->tester_5 }}</td>--}}
            {{--                </tr>--}}
            {{--            @endforeach--}}
            {{--            </tbody>--}}
            {{--        </table>--}}
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
