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
            <div class="breadcrumb-title pe-3">Board Details</div>
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
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('manager.add.task',$board->id) }}" type="button" class="btn btn-info px-5"><i
                            class='bx bx-add-to-queue mr-1'></i>Add Task</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="page-content">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4">
                    <div class="col">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <p class="mb-0 text-white">Total Task</p>
                                        <h4 class="my-1 text-white">{{count($today_tasks)}}</h4>
                                        <p class="mb-0 font-13 text-white">+2.5% from yesterday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <p class="mb-0 text-white">Completed</p>
                                        <h4 class="my-1 text-white">{{count(\App\Models\Task::where('working_status', 2) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</h4>
                                        <p class="mb-0 font-13 text-white">-4.5% from yesterday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <p class="mb-0 text-dark">In Progress</p>
                                        <h4 class="my-1 text-dark">{{count(\App\Models\Task::where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</h4>
                                        <p class="mb-0 font-13 text-dark">+8.4% from yesterday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <p class="mb-0 text-white">Bug Found</p>
                                        <h4 class="my-1 text-white">{{count(\App\Models\Task::where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</h4>
                                        <p class="mb-0 font-13 text-white">+5.4% from yesterday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--end row-->
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span class="font-weight-bold">Search and Filter</span>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background: #EEEEEE">
                                <div class="bs-stepper-content">
                                    <form id="myForm" action="{{ route('task.filter') }}" method="get">
                                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane"
                                             aria-labelledby="stepper1trigger1">
                                            <input type="hidden" name="board_id" value="{{$board-> id}}">
                                            <div class="row g-3">
                                                <div class="col-12 col-lg-2">
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>From:</b></label>
                                                        <input type="date" value="{{$dateS}}" name="from_date"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>To:</b></label>
                                                        <input type="date" value="{{$dateT}}" name="to_date"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-lg-2">
                                                    <label for="type" class="form-label"><b>Type</b></label>
                                                    <div class="form-check">
                                                        @foreach ($types as $type)
                                                            @if(isset($request))
                                                                <input class="form-check-input" name="type[]"
                                                                       type="checkbox"
                                                                       {{in_array($type->id, $request -> type) && count($request -> type) != count($types)? 'checked':''}}  value="{{ $type->id }}"
                                                                       id="type{{ $type->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $type->name }}
                                                                </label> <br>
                                                            @else
                                                                <input class="form-check-input" name="type[]"
                                                                       type="checkbox"
                                                                       value="{{ $type->id }}"
                                                                       id="type{{ $type->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $type->name }}
                                                                </label> <br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="team" class="form-label"><b>Team</b></label>
                                                    <div class="form-check">
                                                        @foreach ($teams as $team)
                                                            @if(isset($request))
                                                                <input class="form-check-input" name="team[]"
                                                                       type="checkbox"
                                                                       {{in_array($team->id, $request -> team ) && count($request -> team) != count($teams)? 'checked':''}}  value="{{ $team->id }}"
                                                                       id="type{{ $team->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $team->name }}
                                                                </label> <br>
                                                            @else
                                                                <input class="form-check-input" name="team[]"
                                                                       type="checkbox"
                                                                       value="{{ $team->id }}"
                                                                       id="type{{ $team->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $team->name }}
                                                                </label> <br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="working_status" class="form-label"><b>Working
                                                            Status</b></label>
                                                    <div class="form-check">

                                                        @foreach ($working_statuses as $working_status)
                                                            @if(isset($request))
                                                                <input class="form-check-input" name="working_status[]"
                                                                       type="checkbox"
                                                                       {{in_array($working_status->id, $request -> working_status ) && count($request -> working_status) != count($working_statuses)? 'checked':''}}  value="{{ $working_status->id }}"
                                                                       id="type{{ $working_status->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $working_status->name }}
                                                                </label> <br>
                                                            @else
                                                                <input class="form-check-input" name="working_status[]"
                                                                       type="checkbox"
                                                                       value="{{ $working_status->id }}"
                                                                       id="type{{ $working_status->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $working_status->name }}
                                                                </label> <br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="ticket_status" class="form-label"><b>Ticket
                                                            Status</b></label>
                                                    <div class="form-check">
                                                        @foreach ($ticket_statuses as $ticket_status)
                                                            @if(isset($request))
                                                                <input class="form-check-input" name="ticket_status[]"
                                                                       type="checkbox"
                                                                       {{in_array($ticket_status->id, $request -> ticket_status ) && count($request -> ticket_status) != count($ticket_statuses)? 'checked':''}}  value="{{ $ticket_status->id }}"
                                                                       id="type{{ $ticket_status->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $ticket_status->name }}
                                                                </label> <br>
                                                            @else
                                                                <input class="form-check-input" name="ticket_status[]"
                                                                       type="checkbox"
                                                                       value="{{ $ticket_status->id }}"
                                                                       id="type{{ $ticket_status->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $ticket_status->name }}
                                                                </label> <br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="priority" class="form-label"><b>Priority</b></label>
                                                    <div class="form-check">

                                                        @foreach ($priorities as $priority)
                                                            @if(isset($request))
                                                                <input class="form-check-input" name="priority[]"
                                                                       type="checkbox"
                                                                       {{in_array($priority->id, $request -> priority ) && count($request -> priority) != count($priorities)? 'checked':''}}  value="{{ $priority->id }}"
                                                                       id="type{{ $priority->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $priority->name }}
                                                                </label> <br>
                                                            @else
                                                                <input class="form-check-input" name="priority[]"
                                                                       type="checkbox"
                                                                       value="{{ $priority->id }}"
                                                                       id="type{{ $priority->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $priority->name }}
                                                                </label> <br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="tester" class="form-label"><b>Tester</b></label>
                                                    <div class="form-check">
                                                        @foreach ($users as $user)
                                                            @if(isset($request))
                                                                <input class="form-check-input" name="user[]"
                                                                       type="checkbox"
                                                                       {{in_array($user->id, $request -> user ) && count($request -> user) != count($users)? 'checked':''}}  value="{{ $user->id }}"
                                                                       id="type{{ $user->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $user->name }}
                                                                </label> <br>
                                                            @else
                                                                <input class="form-check-input" name="user[]"
                                                                       type="checkbox"
                                                                       value="{{ $user->id }}"
                                                                       id="type{{ $user->id }}">
                                                                <label class="form-check-label">
                                                                    {{ $user->name }}
                                                                </label> <br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div><!---end row-->
                                            <div class="row mt-1 g-3">
                                                <div class="col-12 col-lg-6">
                                                    <a href="{{route('manager.show.board', $board-> id)}}"
                                                       class="btn btn-secondary px-4" type="reset">
                                                        Reset
                                                    </a>
                                                    <button class="btn btn-primary px-4" type="submit">
                                                        Apply
                                                    </button>
                                                </div>
                                            </div><!---end row-->
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tag-config" role="tab"
                           aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
                                </div>
                                <div class="tab-title"> Task</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                           aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-bookmark-alt font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Report</div>
                            </div>
                        </a>
                    </li>
                    @auth()
                        @if(Auth::user()->role ==='manager')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#reportconfig" role="tab"
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
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Review?</th>
                                            @if($board_config-> team != null)
                                                <th>Team</th>
                                            @endif
                                            @if($board_config-> type != null)
                                                <th>Type</th>
                                            @endif
                                            @if($board_config-> jira_id != null)
                                                <th>ID</th>
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
                                            @if($board_config-> link_to_result != null)
                                                <th>Link To Result</th>
                                            @endif
                                            @if($board_config-> test_plan != null)
                                                <th>Test Plan</th>
                                            @endif
                                            @if($board_config-> sprint != null)
                                                <th>Sprint</th>
                                            @endif
                                            @if($board_config-> note != null)
                                                <th>Note</th>
                                            @endif
                                            @if($board_config-> tester_1 != null)
                                                <th>Tester 1</th>
                                            @endif
                                            @if($board_config-> tester_2 != null)
                                                <th>Tester 2</th>
                                            @endif
                                            @if($board_config-> tester_3 != null)
                                                <th>Tester 3</th>
                                            @endif
                                            @if($board_config-> tester_4 != null)
                                                <th>Tester 4</th>
                                            @endif
                                            @if($board_config-> tester_5 != null)
                                                <th>Tester 5</th>
                                            @endif
                                            <th>Updated at</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($tasks as $key=> $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bg-success">Reviewed </span>
                                                    @else
                                                        <span class="badge bg-danger">Waiting </span>
                                                    @endif
                                                </td>
                                                @if($board_config-> team != 0)
                                                    <td>
                                                        @if($item-> team !=null)
                                                            {{\App\Models\Team::find($item-> team) -> name}}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> type != 0)
                                                    <td>
                                                        @switch($item-> type)
                                                            @case('1')
                                                            <i class="bx bxs-bug-alt text-danger"
                                                               style="font-size: 1.5rem"></i>
                                                            @break
                                                            @case('2')
                                                            <i class="bx bxs-check-square text-primary"
                                                               style="font-size: 1.5rem"></i>
                                                            @break
                                                            @case('3')
                                                            <i class="bx bxs-news text-success"
                                                               style="font-size: 1.5rem"></i>
                                                            @break
                                                            <span
                                                                class="badge bg-warning">{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}} </span>
                                                        @endswitch
                                                    </td>
                                                @endif
                                                @if($board_config-> jira_id != 0)
                                                    <td>
                                                        @if($item-> jira_id !=null)
                                                            <a href="{{$board_config -> jira_url}}{{$item-> jira_id }}"
                                                               target="_blank">{{ $item->jira_id }}</a>
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> jira_summary != 0)
                                                    <td>
                                                        @if($item-> jira_summary !=null)
                                                            {{ $item->jira_summary }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> working_status != 0)
                                                    <td>
                                                        @switch($item-> working_status)
                                                            @case('1')
                                                            <span
                                                                class="badge bg-primary">{{\App\Models\WorkingStatus::find($item-> working_status) -> name}} </span>
                                                            @break
                                                            @case('2')
                                                            <span
                                                                class="badge bg-success">{{\App\Models\WorkingStatus::find($item-> working_status) -> name}} </span>
                                                            @break
                                                            @case('3')
                                                            <span
                                                                class="badge bg-info">{{\App\Models\WorkingStatus::find($item-> working_status) -> name}} </span>
                                                            @break
                                                            @case('4')
                                                            <span
                                                                class="badge bg-secondary">{{\App\Models\WorkingStatus::find($item-> working_status) -> name}} </span>
                                                            @break
                                                            @case(null)
                                                            <span>------------</span>
                                                            @break
                                                            @case('')
                                                            <span>------------</span>
                                                            @break
                                                            @default
                                                            <span
                                                                class="badge bg-warning">{{\App\Models\WorkingStatus::find($item-> working_status) -> name}} </span>
                                                        @endswitch
                                                    </td>
                                                @endif
                                                @if($board_config-> ticket_status != 0)
                                                    <td>

                                                        @switch($item-> ticket_status)
                                                            @case('1')
                                                            <span
                                                                class="badge bg-primary">{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}}</span>
                                                            @break
                                                            @case('2')
                                                            <span
                                                                class="badge bg-success">{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}} </span>
                                                            @break
                                                            @case('3')
                                                            <span
                                                                class="badge bg-success">{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}} </span>
                                                            @break
                                                            @case('4')
                                                            <span
                                                                class="badge bg-primary">{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}}</span>
                                                            @break
                                                            @case('5')
                                                            <span
                                                                class="badge bg-primary">{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}}</span>
                                                            @break
                                                            @case(null)
                                                            <span>------------</span>
                                                            @break
                                                            @default
                                                            <span
                                                                class="badge bg-warning">{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}} </span>
                                                        @endswitch
                                                    </td>
                                                @endif
                                                @if($board_config-> priority != 0)
                                                    <td>
                                                        @if($item-> priority !=null)
                                                            {{\App\Models\Priority::find($item-> priority) -> name}}
                                                        @endif
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
                                                            <a target="_blank" href="{{ $item->test_plan }}">Test
                                                                Plan</a>
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
                                                @if($board_config-> note != 0)
                                                    <td>
                                                        @if($item-> test_plan !=null)
                                                            {{ $item->note }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> tester_1 != 0)
                                                    <td>{{ \App\Models\User::find($item-> tester_1) -> name }}</td>
                                                @endif
                                                @if($board_config-> tester_2 != 0)
                                                    <td>
                                                        @if($item-> tester_2 !=null)
                                                            {{ \App\Models\User::find($item-> tester_2) -> name }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> tester_3 != 0)
                                                    <td>
                                                        @if($item-> tester_3 !=null)
                                                            {{ \App\Models\User::find($item-> tester_3) -> name }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> tester_4 != 0)
                                                    <td>
                                                        @if($item-> tester_4 !=null)
                                                            {{ \App\Models\User::find($item-> tester_4) -> name }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> tester_5 != 0)
                                                    <td>
                                                        @if($item-> tester_5    !=null)
                                                            {{ \App\Models\User::find($item-> tester_5) -> name }}
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>
                                                    @if($item->updated_at !=null)
                                                        {{ $item->updated_at }}
                                                    @else
                                                        {{ $item->created_at }}
                                                    @endif
                                                </td>
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
                                                                <a href="{{ route('manager.edit.task',$item->id) }}"
                                                                   title="Edit" class=""><i
                                                                        class='bx bxs-edit text-primary'></i></a>
                                                            @endif
                                                            @if(Auth::user()->role ==='manager' || Auth::user() -> id == $item -> tester_1 )
                                                                <a href="{{ route('manager.delete.task',$item->id) }}"
                                                                   id="Delete"
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
                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        <div>
                            <div class="container-fluid mt-5">
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
                                                        style="font-size:11pt;"><a
                                                            name="_Hlk155304048">Hi Roger,</a></span></font></div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;">Below is our status report for today. Please review and let us know if you have any comments or questions.</span></font>
                                            </div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            size="4"><span
                                                                style="font-size:14pt;"><b>&nbsp;</b></span></font></span></font>
                                            </div>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            size="4"><span
                                                                style="font-size:14pt;"><b>Summary:</b></span></font></span></font>
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
                                                        style="width:63.25pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:rgb(189,215,238);padding:0in 5.4pt;height:15pt">
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
                                                        style="width:61.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:rgb(189,215,238);padding:0in 5.4pt;height:15pt">
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
                                                                        style="color:black">{{count(\App\Models\Task::where('team', $team -> id) -> where('type', 2) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
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
                                                            <td width="82" nowrap=""
                                                                style="background-color: {{$team -> desc}};width:61.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;padding:0in 5.4pt;height:15pt">
                                                                <p class="MsoNormal" align="center"
                                                                   style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif">
                                                                    <span
                                                                        style="color:black">{{count(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
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
                                                            size="4"><span style="font-size:14pt;"><b>Details of the assignment:</b></span></font></span></font>
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
                                                                            style="font-size:11pt;"><a
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
                                                                        style="font-size:11pt;"><a
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
                                                                            style="font-size:11pt;"><a
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
                                                                    style="font-size:11pt;"><font
                                                                        color="black"><b>In-progress</b></font></span></font>
                                                        </div>
                                                        @foreach(\App\Models\Task::where('team', $team -> id) -> where('type', 3) -> where('working_status', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $inprogres)
                                                            <div
                                                                style="text-indent:33pt;margin:0;"><font
                                                                    face="Calibri,sans-serif"
                                                                    size="2"><span
                                                                        style="font-size:11pt;"><a
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
                                                                        style="font-size:11pt;"><font size="4"
                                                                                                      color="black"><span
                                                                                style="font-size:14pt;"><b>Bugs reported</b></span></font></span></font>
                                                            </div>
                                                            @foreach(\App\Models\Task::where('team', $team -> id) -> where('type', 1) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get() as $bug_found)
                                                                <div
                                                                    style="text-indent:33pt;margin:0;"><font
                                                                        face="Calibri,sans-serif" size="2"><span
                                                                            style="font-size:11pt;"><a
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
                                                        style="font-size:11pt;">Thank you and best regards,</span></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reportconfig" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" action="{{ route('manager.save-report-config') }}" method="post"
                                      class="row g-3"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <h5 class="mb-4">Report Config</h5>
                                        <input type="hidden" name="board_id" value="{{$board -> id}}">
                                        <div class="row mb-3">
                                            <label for="project_name" class="col-sm-3 col-form-label">Board Name</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative input-icon">
                                                    <input type="text" class="form-control" disabled
                                                           value="{{$board ->name}}" id="board_name">
                                                    <span class="position-absolute top-50 translate-middle-y"><i
                                                            class='bx bx-user'></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="subject" class="col-sm-3 col-form-label">Subject</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <div class="position-relative input-icon">
                                                        <input type="text" class="form-control"
                                                               name="subject" id="subject"
                                                               value="{{$report_config -> subject}}">
                                                        <span class="position-absolute top-50 translate-middle-y"><i
                                                                class='bx bx-user'></i></span>
                                                    </div>
                                                </div>
                                                @error('subject')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="cc" class="col-sm-3 col-form-label">CC List</label>
                                            <div class="col-sm-9">
                                <textarea class="form-control" name="cc" id="cc" rows="5"
                                          placeholder="Enter the cc list ...">{{$report_config -> cc}}</textarea>
                                                @error('cc')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="date_format" class="col-sm-3 col-form-label">Date Format</label>
                                            <div class="col-sm-9">

                                                <div class="col-sm-9">
                                                    <div class="position-relative input-icon">
                                                        <input type="text" class="form-control"
                                                               name="date_format" id="date_format"
                                                               value="{{$report_config -> date_format}}">
                                                        <span class="position-absolute top-50 translate-middle-y"><i
                                                                class='bx bx-user'></i></span>
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
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-5"><i
                                                            class='bx bx-add-to-queue mr-1'></i>Save Report Config
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
                    <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" action="{{ route('manager.update-board-config') }}" method="post"
                                      class="row g-3"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <h5 class="mb-4">Board Config</h5>
                                        <input type="hidden" name="board_config_id" value="{{$board_config -> id}}">
                                        <div class="row mb-3">
                                            <label for="project_name" class="col-sm-3 col-form-label">Board Name</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative input-icon">
                                                    <input type="text" class="form-control" disabled
                                                           value="{{$board ->name}}" id="board_name">
                                                    <span class="position-absolute top-50 translate-middle-y"><i
                                                            class='bx bx-user'></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="jira_url" class="col-sm-3 col-form-label">Jira URL</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <div class="position-relative input-icon">
                                                        <input type="text" class="form-control"
                                                               value="{{$board_config ->jira_url}}"
                                                               name="jira_url" id="jira_url">
                                                        <span class="position-absolute top-50 translate-middle-y"><i
                                                                class='bx bx-user'></i></span>
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
                                                    <label class="form-check-label" for="team1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> team == 0 ? 'checked': ''}} type="radio"
                                                           name="team" id="team0" value="0">
                                                    <label class="form-check-label" for="team0">Disable</label>
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
                                                    <label class="form-check-label" for="type1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> type == 0 ? 'checked': ''}} type="radio"
                                                           name="type" id="type0" value="0">
                                                    <label class="form-check-label" for="type0">Disable</label>
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
                                                    <label class="form-check-label" for="jira_id1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> jira_id == 0 ? 'checked': ''}} type="radio"
                                                           name="jira_id" id="jira_id0" value="0">
                                                    <label class="form-check-label" for="jira_id0">Disable</label>
                                                </div>
                                                @error('jira_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Jira Summary</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> jira_summary == 1 ? 'checked': ''}} type="radio"
                                                           name="jira_summary" id="jira_summary1" value="1">
                                                    <label class="form-check-label" for="jira_summary1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> jira_summary == 0 ? 'checked': ''}} type="radio"
                                                           name="jira_summary" id="jira_summary0" value="0">
                                                    <label class="form-check-label" for="jira_summary0">Disable</label>
                                                </div>
                                                @error('jira_summary')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Working Status</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> working_status == 1 ? 'checked': ''}} type="radio"
                                                           name="working_status" id="working_status1" value="1">
                                                    <label class="form-check-label" for="working_status1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> working_status == 0 ? 'checked': ''}} type="radio"
                                                           name="working_status" id="working_status0" value="0">
                                                    <label class="form-check-label"
                                                           for="working_status0">Disable</label>
                                                </div>
                                                @error('working_status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Ticket Status</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> ticket_status == 1 ? 'checked': ''}} type="radio"
                                                           name="ticket_status" id="ticket_status1" value="1">
                                                    <label class="form-check-label" for="ticket_status1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> ticket_status == 0 ? 'checked': ''}} type="radio"
                                                           name="ticket_status" id="ticket_status0" value="0">
                                                    <label class="form-check-label" for="ticket_status0">Disable</label>
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
                                                           type="radio" name="priority" id="priority1" value="1">
                                                    <label class="form-check-label" for="ticket_status1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> priority == 0 ? 'checked': ''}} type="radio"
                                                           name="priority" id="priority0" value="0">
                                                    <label class="form-check-label" for="ticket_status0">Disable</label>
                                                </div>
                                                @error('priority')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Link To Result</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> link_to_result == 1 ? 'checked': ''}} type="radio"
                                                           name="link_to_result" id="link_to_result1" value="1">
                                                    <label class="form-check-label" for="link_to_result1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> link_to_result == 0 ? 'checked': ''}} type="radio"
                                                           name="link_to_result" id="link_to_result0" value="0">
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
                                                           name="test_plan" id="test_plan1" value="1">
                                                    <label class="form-check-label" for="test_plan1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> test_plan == 0 ? 'checked': ''}} type="radio"
                                                           name="test_plan" id="test_plan0" value="0">
                                                    <label class="form-check-label" for="test_plan0">Disable</label>
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
                                                    <label class="form-check-label" for="sprint1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> sprint == 0 ? 'checked': ''}} type="radio"
                                                           name="sprint" id="sprint0" value="0">
                                                    <label class="form-check-label" for="sprint0">Disable</label>
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
                                                    <label class="form-check-label" for="note1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> note == 0 ? 'checked': ''}} type="radio"
                                                           name="note" id="note0" value="0">
                                                    <label class="form-check-label" for="note0">Disable</label>
                                                </div>
                                                @error('note')
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
                                                    <label class="form-check-label" for="tester_11">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_1 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_1" id="tester_10" value="0">
                                                    <label class="form-check-label" for="tester_10">Disable</label>
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
                                                    <label class="form-check-label" for="tester_21">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_2 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_2" id="tester_20" value="0">
                                                    <label class="form-check-label" for="tester_20">Disable</label>
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
                                                    <label class="form-check-label" for="tester_31">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_3 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_3" id="tester_30" value="0">
                                                    <label class="form-check-label" for="tester_30">Disable</label>
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
                                                    <label class="form-check-label" for="tester_41">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_4 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_4" id="tester_40" value="0">
                                                    <label class="form-check-label" for="tester_40">Disable</label>
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
                                                    <label class="form-check-label" for="tester_51">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           {{$board_config -> tester_5 == 0 ? 'checked': ''}} type="radio"
                                                           name="tester_5" id="tester_50" value="0">
                                                    <label class="form-check-label" for="tester_50">Disable</label>
                                                </div>
                                                @error('tester_5')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-5"><i
                                                            class='bx bx-add-to-queue mr-1'></i>Save Config
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
@endsection
