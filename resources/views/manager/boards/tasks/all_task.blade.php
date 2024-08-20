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
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('manager.all.boards',$board-> project_id) }}">{{\App\Models\Board::getProjectById($board-> project_id)-> name}} Project</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager.show.board', $board -> id)}}">{{$board -> name}} Board</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Tasks</li>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
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
                                @if($board_config-> team != 0)
                                    <td>{{\App\Models\Team::find($item-> team) -> name}}</td>
                                @endif
                                @if($board_config-> type != 0)
                                    <td>{{\App\Models\Type::find($item-> type) -> name}}</td>
                                @endif
                                @if($board_config-> jira_id != 0)
                                    <td>{{ $item->jira_id }}</td>
                                @endif
                                @if($board_config-> jira_summary != 0)
                                    <td>{{ $item->jira_summary }}</td>
                                @endif
                                @if($board_config-> working_status != 0)
                                    <td>{{\App\Models\WorkingStatus::find($item-> working_status) -> name}}</td>
                                @endif
                                @if($board_config-> ticket_status != 0)
                                    <td>{{\App\Models\TicketStatus::find($item-> ticket_status) -> name}}</td>
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
                                        <a href=" {{ $item->link_to_result }}">Link To Result</a>
                                    </td>
                                @endif
                                @if($board_config-> test_plan != 0)
                                    <td><a href="{{ $item->test_plan }}">Test Plan</a></td>
                                @endif
                                @if($board_config-> sprint != 0)
                                    <td>{{ $item->sprint }}</td>
                                @endif
                                @if($board_config-> note != 0)
                                    <td>{{ $item->note }}</td>
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
                                        <a href="{{ route('manager.edit.task',$item->id) }}" title="Edit" class=""><i class='lni lni-eye text-success'></i></a>
                                        <a href="{{ route('manager.edit.task',$item->id) }}" title="Edit" class=""><i class='bx bxs-edit text-primary'></i></a>
                                        <a href="{{ route('manager.delete.task',$item->id) }}" id="Delete"  title="delete" class=""><i class='bx bxs-trash text-danger'></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
