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
    <form method="GET" action="{{ route('tasks.filter') }}" class="row g-3 mb-4">
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
                    <option value="{{ $tester->id }}" {{ ($filters['tester'] ?? '') == $tester->id ? 'selected' : '' }}>
                        {{ $tester->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date Picker -->
        <div class="col-md-2">
            <input type="date" name="date" class="form-control" value="{{ $filters['date'] ?? now()->toDateString() }}">
        </div>

        <!-- Search Bar -->
        <div class="col-md-2">
            <input type="text" name="search" class="form-control" placeholder="Search JIRA ID/Summary" value="{{ $filters['search'] ?? '' }}">
        </div>

        <!-- Submit Button -->
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>


{{--    <!-- Reset Filters -->--}}
{{--    <div class="mb-4">--}}
{{--        <a href="{{ route('tasks.filter') }}" class="btn btn-secondary">Reset Filters</a>--}}
{{--    </div>--}}

    <!-- Tasks Table -->
    @if($tasks->isEmpty())
        <div class="alert alert-warning">No tasks match the selected filters.</div>
    @else
        <table class="table table-striped table-bordered"
               style="width:100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Task ID</th>
                <th>Board</th>
                <th>Team</th>
                <th>Type</th>
                <th>ID</th>
                <th>Jira Summary</th>
                <th>Working Status</th>
                <th>Ticket Status</th>
                <th>Priority</th>
                <th>Link To Result</th>
                <th>Test Plan</th>
                <th>Sprint</th>
                <th>Note</th>
                <th>Pass TC</th>
                <th>Fail TC</th>
                <th>Total TC</th>
                <th>Tester 1</th>
                <th>Tester 2</th>
                <th>Tester 3</th>
                <th>Tester 4</th>
                <th>Tester 5</th>
                <th>Updated at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tasks as $key=> $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td><a href="{{ route('task.details',$item->id) }}"
                           title="Task Details">{{ $item -> id }}</a></td>
                    <td>{{\App\Models\Board::find($item-> board_id) -> name}}</td>
                    <td>
                        @if($item-> team !=null)
                            {{\App\Models\Team::find($item-> team) -> name}}
                        @endif
                    </td>
                    <td>
                        @if($item-> type !=null)
                            {{\App\Models\Type::find($item-> type) -> name}}
                        @endif
                    </td>
                    <td>
                    @if(isset($request))
                        @if($request -> unique_flag == 'on')
                            <!-- Button trigger modal -->
                                <a type="button" class="btn-sm btn-outline-info" data-bs-toggle="modal"
                                   data-bs-target="#exampleExtraLargeModal{{$item->jira_id}}">{{ $item->jira_id }}
                                    @if( count(\App\Models\Task::getAllTaskWithSameJiraId($item -> id)) > 1 )
                                        <i
                                            class='bx bx-history mr-1'></i>
                                        {{count(\App\Models\Task::getAllTaskWithSameJiraId($item -> id))}}
                                    @endif
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleExtraLargeModal{{$item->jira_id}}"
                                     tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Task History</h5>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table id="example"
                                                       class="table table-striped table-bordered"
                                                       style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Jira ID</th>
                                                        <th>Jira Summary</th>
                                                        <th>Test Case Pass</th>
                                                        <th>Test Case Fail</th>
                                                        <th>Total Test Case</th>
                                                        <th>Update At</th>
                                                        <th>Created At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach (\App\Models\Task::getAllTaskWithSameJiraId($item -> id) as $key=> $it)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td><a target="_blank"
                                                                   href=" {{ url('https://jira.sonos.com/browse/'.$it->jira_id) }}">{{ $it->jira_id }}</a>
                                                            </td>
                                                            <td>{{ \Illuminate\Support\Str::limit($it->jira_summary, 40, $end=' ...') }}</td>
                                                            <td><span
                                                                    class="badge bg-success rounded-pill">{{ $it->pass }}</span>
                                                            </td>
                                                            <td><span
                                                                    class="badge bg-danger rounded-pill">{{ $item->fail }}</span>
                                                            </td>
                                                            <td><span
                                                                    class="badge bg-primary rounded-pill">{{$it->pass + $it -> fail }}</span>
                                                            </td>
                                                            <td>{{$it -> updated_at}}</td>
                                                            <td>{{$it -> created_at}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
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
                                <a target="_blank"
                                   href=" {{ url('https://jira.sonos.com/browse/'.$item->jira_id) }}">{{ $item->jira_id }}</a>
                            @endif
                        @else
                            <a target="_blank"
                               href=" {{ url('https://jira.sonos.com/browse/'.$item->jira_id) }}">{{ $item->jira_id }}</a>
                        @endif
                    </td>
                    <td>
                        {{ $item->jira_summary }}
                    </td>
                    <td>
                        @if($item-> working_status !=null)
                            <span
                                class="badge"
                                style="background-color: {{\App\Models\WorkingStatus::find($item-> working_status) -> desc}}">{{\App\Models\WorkingStatus::find($item-> working_status) -> name}} </span>
                        @endif
                    </td>
                    <td>
                        @if($item-> ticket_status !=null)
                            <span
                                class="badge"
                                style="background-color: {{\App\Models\TicketStatus::find($item-> ticket_status) -> desc}}">{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}}</span>
                        @endif
                    </td>
                    <td>
                        @if($item-> priority !=null)
                            {{\App\Models\Priority::find($item-> priority) -> name}}
                        @endif
                    </td>
                    <td>
                        @if($item-> link_to_result !=null)
                            <a target="_blank" href=" {{ $item->link_to_result }}">Link
                                To Result</a>
                        @endif                                </td>
                    <td>
                        <a target="_blank"
                           href="{{ url('https://sonos.testrail.com/index.php?/plans/view/'.$item->test_plan) }}">{{$item->test_plan}}</a>
                    </td>

                    <td>
                        {{ $item->sprint }}
                    </td>
                    <td>
                        {{ $item->note }}
                    </td>
                    <td>
                        @if(isset($request))
                            @if(\App\Models\Task::getTotalTesCasePassByTaskId($item -> id) !=0)
                                @if($request -> unique_flag == 'on')
                                    <span
                                        class="badge bg-success rounded-pill">{{ \App\Models\Task::getTotalTesCasePassByTaskId($item -> id) }}</span>
                                @else
                                    <span class="badge bg-success rounded-pill">{{ $item->pass }}</span>
                                @endif
                            @endif
                        @else
                            @if($item->pass !=0)
                                <span class="badge bg-success rounded-pill">{{ $item->pass }}</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if(isset($request))
                            @if(\App\Models\Task::getTotalTesCaseFailByTaskId($item -> id) !=0)
                                @if($request -> unique_flag == 'on')
                                    <span
                                        class="badge bg-danger rounded-pill">{{ \App\Models\Task::getTotalTesCaseFailByTaskId($item -> id) }}</span>
                                @else
                                    <span class="badge bg-danger rounded-pill">{{ $item->fail }}</span>
                                @endif
                            @endif
                        @else
                            @if($item->fail !=0)
                                <span class="badge bg-danger rounded-pill">{{ $item->fail }}</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if(isset($request))
                            @if(\App\Models\Task::getTotalTesCaseFailByTaskId($item -> id) !=0)
                                @if($request -> unique_flag == 'on')
                                    <span
                                        class="badge bg-primary rounded-pill">{{ \App\Models\Task::getTotalTesCaseFailByTaskId($item -> id) +  \App\Models\Task::getTotalTesCasePassByTaskId($item -> id)}}</span>
                                @else
                                    <span
                                        class="badge bg-primary rounded-pill">{{ $item->pass + $item -> fail }}</span>
                                @endif
                            @endif
                        @else
                            @if($item->fail !=0)
                                <span
                                    class="badge bg-primary rounded-pill">{{ $item->pass + $item -> fail }}</span>
                            @endif
                        @endif
                    </td>

                    <td>{{ \App\Models\User::find($item-> tester_1) -> name }}</td>
                    <td>
                        @if($item-> tester_2 !=null)
                            {{ \App\Models\User::find($item-> tester_2) -> name }}
                        @endif
                    </td>
                    <td>
                        @if($item-> tester_3 !=null)
                            {{ \App\Models\User::find($item-> tester_3) -> name }}
                        @endif
                    </td>
                    <td>
                        @if($item-> tester_4 !=null)
                            {{ \App\Models\User::find($item-> tester_4) -> name }}
                        @endif
                    </td>
                    <td>
                        @if($item-> tester_5    !=null)
                            {{ \App\Models\User::find($item-> tester_5) -> name }}
                        @endif
                    </td>
                    <td>
                        @if($item->updated_at !=null)
                            {{ $item->updated_at }}
                        @else
                            {{ $item->created_at }}
                        @endif
                    </td>
                    <td>
                        <div class="d-flex order-actions">
                            <a href="{{ route('manager.edit.task',$item->id) }}" title="Edit" class=""><i
                                    class='lni lni-eye text-success'></i></a>
                            <a href="{{ route('manager.edit.task',$item->id) }}" title="Edit" class=""><i
                                    class='bx bxs-edit text-primary'></i></a>
                            <a href="{{ route('manager.delete.task',$item->id) }}" id="Delete"
                               title="delete" class=""><i class='bx bxs-trash text-danger'></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
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
