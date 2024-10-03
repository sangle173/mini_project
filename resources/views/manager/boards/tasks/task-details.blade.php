@extends('manager.manager_dashboard')
@section('users')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">View Task</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{ route('manager.show.board', \App\Models\Board::find($task-> board_id) -> id) }}">{{\App\Models\Board::find($task-> board_id) -> name}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Task Details</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">

                        <ul class="list-group">
                            <li class="list-group-item">
                                Status:
                                @if ($task->status == 1)
                                    <span class="badge bg-success">Reviewed </span>
                                @else
                                    <span class="badge bg-danger">Waiting </span>
                                @endif
                            </li>
                            @if($board_config-> team != 0)
                                <li class="list-group-item">
                                    Team:
                                    @if($task-> team !=null)
                                        {{\App\Models\Team::find($task-> team) -> name}}
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> type != 0)
                                <li class="list-group-item">
                                    Type:
                                    @if($task-> type !=null)
                                        {{\App\Models\Type::find($task-> type) -> name}}
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> jira_id != 0)
                                <li class="list-group-item">
                                    Jira ID:
                                    @if($task-> jira_id !=null)
                                        <a href="{{$board_config -> jira_url}}{{$task-> jira_id }}"
                                           target="_blank">{{ $task->jira_id }}</a>
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> jira_summary != 0)
                                <li class="list-group-item">Jira Summary:
                                    @if($task-> jira_summary !=null)
                                        {{ $task->jira_summary }}
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> working_status != 0)
                                <li class="list-group-item">Working Status:
                                    @if($task-> working_status !=null)
                                        {{\App\Models\WorkingStatus::find($task-> working_status) -> name}}
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> ticket_status != 0)
                                <li class="list-group-item">Ticket Status:
                                    @if($task-> ticket_status !=null)
                                        {{\App\Models\TicketStatus::find($task-> ticket_status) -> name}}
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> priority != 0)
                                <li class="list-group-item">Priority:
                                    @if($task-> priority !=null)
                                        {{\App\Models\Priority::find($task-> priority) -> name}}
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> link_to_result != 0)
                                <li class="list-group-item">Link to result:
                                    @if($task-> link_to_result !=null)
                                        <a target="_blank" href="{{ $task->link_to_result }}">Link</a>

                                    @endif
                                </li class="list-group-item">
                            @endif
                            @if($board_config-> test_plan != 0)
                                <li class="list-group-item">Test Plan:
                                    @if($task-> test_plan !=null)
                                        <a target="_blank" href="{{ $task->test_plan }}">Test
                                            Plan</a>
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> sprint != 0)
                                <li class="list-group-item">Sprint:
                                    @if($task-> test_plan !=null)
                                        {{ $task->sprint }}
                                    @endif
                                </li>
                            @endif

                            @if($board_config-> tester_1 != 0)
                                <li class="list-group-item">Tester
                                    1:{{ \App\Models\User::find($task-> tester_1) -> name }}</li>
                            @endif
                            @if($board_config-> tester_2 != 0)
                                <li class="list-group-item">Tester 2:
                                    @if($task-> tester_2 !=null)
                                        {{ \App\Models\User::find($task-> tester_2) -> name }}
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> tester_3 != 0)
                                <li class="list-group-item">Tester 3:
                                    @if($task-> tester_3 !=null)
                                        {{ \App\Models\User::find($task-> tester_3) -> name }}
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> tester_4 != 0)
                                <li class="list-group-item">Tester 4:
                                    @if($task-> tester_4 !=null)
                                        {{ \App\Models\User::find($task-> tester_4) -> name }}
                                    @endif
                                </li>
                            @endif
                            @if($board_config-> tester_5 != 0)
                                <li class="list-group-item">Tester 5:
                                    @if($task-> tester_5    !=null)
                                        {{ \App\Models\User::find($task-> tester_5) -> name }}
                                    @endif
                                </li>
                            @endif

                            @if($board_config-> note != 0)
                                <li class="list-group-item">Note:
                                    @if($task-> test_plan !=null)
                                        <i>{{ $task->note }}</i>
                                    @endif
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card bg-transparent shadow-none">
                        <div class="card-body">
                            <h5 class="card-title">Comments</h5>
                            <form id="myForm" action="{{ route('comment.save') }}" method="post" class="row g-3"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$task -> id}}" name="task_id">
                                <div class="input-group mb-3">
                                    <input type="text" name="contents" class="form-control" placeholder="Type message"
                                           aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                                            class="bx bxs-send text-primary"></i>
                                    </button>
                                </div>
                            </form>
                            @foreach($comments as $item)
                                <hr/>
                                <div
                                    class="alert border-0 border-start border-5 border-primary alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <img width="42" height="42" class="rounded-circle"
                                             src="{{ (!empty(\App\Models\User::find($item -> user_id)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($item -> user_id)->photo) : url('upload/no_image.jpg')}}"
                                             alt="Contact Person">
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-primary">{{\App\Models\User::find($item -> user_id) -> name}}
                                                <span
                                                    style="font-weight: normal;color: black">{{$item -> created_at}}</span>
                                            </h6>
                                            <div>{{$item -> content}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card bg-transparent shadow-none">
                        <div class="card-body">
                            <form id="myForm" action="{{route('task.review')}}" method="post" class="row g-3"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="task_id" value="{{$task-> id}}">
                                <div class="col-md-12">
                                    <label for="input11" class="form-label"><b>Review: </b></label>
                                    <textarea class="form-control" id="input11" name="review"
                                              placeholder="Enter review ..."
                                              rows="3">{{$task -> review != null ? $task -> review : ''}}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check-success form-check form-switch">
                                        <input class="form-check-input" name="status" type="checkbox"
                                               id="flexSwitchCheckCheckedDanger" {{$task -> status == 1 ? 'checked': ''}}>
                                        <label class="form-check-label" for="flexSwitchCheckCheckedDanger">Review
                                            Status?</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                                        <button type="reset" class="btn btn-secondary px-4">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
