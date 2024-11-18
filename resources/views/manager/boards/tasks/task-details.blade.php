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
                        <table class="table table-bordered">
                            <thead style="background-color: #EEEEEE">
                            <tr>
                                <th colspan="2">Overview</th>
                                <th style="width: 10%" scope="col">
                                    @if(Auth::user()->role ==='manager' || Auth::user() -> id == $task -> tester_1 )
                                        <a href="{{ route('manager.edit.task',$task->id) }}"
                                           title="Edit" class=""><i
                                                class='bx bxs-edit text-primary'></i></a>
                                    @endif
                                    @if(Auth::user()->role ==='manager' || Auth::user() -> id == $task -> tester_1 )
                                        <a href="{{ route('manager.delete.task',$task->id) }}"
                                           id="delete"
                                           title="delete" class=""><i
                                                class='bx bxs-trash text-danger'></i></a>
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td width="20%">Review Status</td>
                                <td colspan="2">
                                    @if ($task->status == 1)
                                        <span class="badge bg-success">Reviewed </span>
                                    @else
                                        <span class="badge bg-danger">Waiting </span>
                                    @endif
                                </td>
                            </tr>
                            @if($board_config-> team != 0)
                                <tr>
                                    <td width="20%">Team</td>
                                    @if($task-> team !=null)

                                        <td colspan="2">
                                            @if($task-> team !=null)
                                                {{\App\Models\Team::find($task-> team) -> name}}
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if($board_config-> type != 0)
                                <tr>
                                    <td width="20%">Type</td>
                                    @if($task-> type !=null)
                                        <td colspan="2">
                                            @if($task-> type !=null)
                                                {{\App\Models\Type::find($task-> type) -> name}}
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if($board_config-> jira_id != 0)
                                <tr>
                                    <td width="20%">Jira Summary</td>
                                    @if($task-> jira_id !=null)
                                        <td colspan="2">
                                            <a href="{{url($board_config -> jira_url . $task-> jira_id) }}"
                                               target="_blank">{{ $task->jira_id }}</a>
                                            - {{ $task->jira_summary }}
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if($board_config-> working_status != 0)
                                <tr>
                                    <td width="20%">Working Status</td>
                                    @if($task-> working_status !=null)
                                        <td colspan="2">
                                            <span
                                                class="badge"
                                                style="background-color: {{\App\Models\WorkingStatus::find($task-> working_status) -> desc}}">{{\App\Models\WorkingStatus::find($task-> working_status) -> name}} </span>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if($board_config-> ticket_status != 0)
                                <tr>
                                    <td width="20%">Ticket Status</td>
                                    @if($task-> ticket_status !=null)
                                        <td colspan="2">
                                            <span
                                                class="badge"
                                                style="background-color: {{\App\Models\TicketStatus::find($task-> ticket_status) -> desc}}">{{\App\Models\TicketStatus::find($task-> ticket_status) -> name}} </span>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if($board_config-> priority != 0)
                                <tr>
                                    <td width="20%">Priority</td>
                                    @if($task-> priority !=null)
                                        <td colspan="2">
                                            {{\App\Models\Priority::find($task-> priority) -> name}}
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if($board_config-> link_to_result != 0)
                                <tr>
                                    <td width="20%">Link To Result</td>
                                    @if($task-> link_to_result !=null)
                                        <td colspan="2">
                                            <a target="_blank" href="{{ $task->link_to_result }}">Link</a>
                                        </td>
                                    @endif
                                </tr>
                            @endif

                            @if($board_config-> sprint != 0)
                                <tr>
                                    <td width="20%">Sprint</td>
                                    @if($task-> sprint !=null)
                                        <td colspan="2">
                                            {{ $task->sprint }}
                                        </td>
                                    @endif
                                </tr>
                            @endif

                            @if($board_config-> tester_1 != 0)
                                <tr>
                                    <td>Testers</td>
                                    <td colspan="2">
                                        @if($task-> tester_1 !=null || $task-> tester_1 !=0 )
                                            <div style="" class="chip chip-sm bg-light text-dark">
                                                <img
                                                    src="{{ (!empty(\App\Models\User::find($task -> tester_1)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($task -> tester_1)->photo) : url('upload/no_image.jpg')}}"
                                                    alt="Tester">{{\App\Models\User::find($task -> tester_1) -> name}}
                                            </div>
                                        @endif
                                        @if($task-> tester_2 !=null || $task-> tester_2 !=0 )
                                            <div class="chip chip-sm bg-light text-dark">
                                                <img
                                                    src="{{ (!empty(\App\Models\User::find($task -> tester_2)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($task -> tester_2)->photo) : url('upload/no_image.jpg')}}"
                                                    alt="Tester">{{\App\Models\User::find($task -> tester_2) -> name}}
                                            </div>
                                        @endif
                                        @if($task-> tester_3 !=null || $task-> tester_3 !=0 )
                                            <div class="chip chip-sm bg-light text-dark">
                                                <img
                                                    src="{{ (!empty(\App\Models\User::find($task -> tester_3)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($task -> tester_3)->photo) : url('upload/no_image.jpg')}}"
                                                    alt="Tester">{{\App\Models\User::find($task -> tester_3) -> name}}
                                            </div>
                                        @endif
                                        @if($task-> tester_4 !=null || $task-> tester_4 !=0 )
                                            <div class="chip chip-sm bg-light text-dark">
                                                <img
                                                    src="{{ (!empty(\App\Models\User::find($task -> tester_4)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($task -> tester_4)->photo) : url('upload/no_image.jpg')}}"
                                                    alt="Tester">{{\App\Models\User::find($task -> tester_4) -> name}}
                                            </div>
                                        @endif
                                        @if($task-> tester_5 !=null || $task-> tester_5 !=0 )
                                            <div class="chip chip-sm bg-light text-dark">
                                                <img
                                                    src="{{ (!empty(\App\Models\User::find($task -> tester_5)->photo)) ? url('upload/manager_images/'.\App\Models\User::find($task -> tester_5)->photo) : url('upload/no_image.jpg')}}"
                                                    alt="Tester">{{\App\Models\User::find($task -> tester_5) -> name}}
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                            @if($board_config-> note != 0)
                                <tr>
                                    <td width="20%">Note</td>
                                    @if($task-> note !=null)
                                        <td colspan="2">
                                            {{ $task->note }}
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if($board_config-> pass != 0)
                                <tr>
                                    <td width="20%">Test Case Pass</td>
                                    @if($task-> pass !=null)
                                        <td colspan="2">
                                            <span class="badge bg-success rounded-pill">{{ $task->pass }}</span>

                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if($board_config-> fail != 0)
                                <tr>
                                    <td width="20%">Test Case Fail</td>
                                    @if($task-> fail !=null)
                                        <td colspan="2">
                                            <span class="badge bg-danger rounded-pill">{{ $task->fail }}</span>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if($board_config-> fail != 0 && $board_config-> fail != 0)
                                <tr>
                                    <td width="20%">Total Executed</td>
                                        <td colspan="2">
                                            <span class="badge bg-primary rounded-pill">{{ $task->fail + $task->pass }}</span>
                                        </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        @if($board_config-> isSubBug != 0)
                            @if(count(\App\Models\Task::where('parent_task_id', $task -> id) ->latest()->get()) !=0)
                                <table class="mt-2 table table-bordered">
                                    <thead style="background-color: #EEEEEE">
                                    <tr>
                                        <th colspan="2">Sub Bugs</th>
                                        <th style="width: 20px">
                                            <div class="d-flex mr-auto order-actions">
                                                <a href="{{ route('manager.add.sub-task',$task->id) }}"
                                                   title="Add sub bug" class=""><i
                                                        class='bx bxs-plus-circle text-primary'></i></a>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Models\Task::where('parent_task_id', $task -> id) ->latest()->get()  as $key => $row)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td><a href="{{url($board_config -> jira_url . $row-> jira_id) }}"
                                                   target="_blank">{{ $row->jira_id }}</a>
                                                - {{ $row->jira_summary }} </td>
                                            <td>
                                                <a
                                                    href="{{ route('manager.edit.sub-task',$row -> id) }}"
                                                    title="Edit sub bug" class=""><i
                                                        class='bx bxs-edit text-info'></i></a>
                                                @if(Auth::user()->role ==='manager' || Auth::user() -> id == $row -> tester_1 )
                                                    <a href="{{ route('manager.delete.task',$row->id) }}"
                                                       id="Delete"
                                                       title="delete" class=""><i
                                                            class='bx bxs-trash text-danger'></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            @else
                                <table class="mt-2 table table-bordered">
                                    <thead style="background-color: #EEEEEE">
                                    <tr>
                                        <th colspan="2">Sub Bugs</th>
                                        <th style="width: 20px">
                                            <div class="d-flex mr-auto order-actions">
                                                <a href="{{ route('manager.add.sub-task',$task->id) }}"
                                                   title="Add sub bug" class=""><i
                                                        class='bx bxs-plus-circle text-primary'></i></a>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="3">No Sub Bugs added</td>
                                    </tr>
                                    </tbody>

                                </table>
                            @endif
                        @endif
                        @if($board_config-> environment != 0)
                            @if($task-> environment !=null)
                                <table class="mt-2 table table-bordered">
                                    <thead style="background-color: #EEEEEE">
                                    <tr>
                                        <th colspan="2">Environments</th>
                                        <th style="width: 20px">
                                            <div class="d-flex mr-auto order-actions">
                                                <a href="{{ route('manager.edit.env',\App\Models\Environment::find($task-> environment) -> id) }}"
                                                   title="Edit env" class=""><i
                                                        class='bx bxs-edit text-info'></i></a>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(\App\Models\Environment::find($task-> environment) -> email !=null)
                                        <tr>
                                            <td width="20%">Emails</td>
                                            <td colspan="2">
                                                @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> email) as $row)
                                                    - <i>{{ $row }}</i> <br>
                                                @endforeach
                                            </td>
                                        </tr>

                                    @endif
                                    @if(\App\Models\Environment::find($task-> environment) -> browser !=null)
                                        <tr>
                                            <td width="20%">Browser</td>
                                            <td colspan="2">
                                                @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> browser) as $row)
                                                    - <i>{{ $row }}</i> <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                    @if(\App\Models\Environment::find($task-> environment) -> player !=null)
                                        <tr>
                                            <td width="20%">Players</td>
                                            <td colspan="2">
                                                @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> player) as $row)
                                                    - <i>{{ $row }}</i> <br>
                                                @endforeach
                                            </td>
                                        </tr>

                                    @endif
                                    @if(\App\Models\Environment::find($task-> environment) -> drop_date !=null)
                                        <tr>
                                            <td width="20%">Drop Date</td>
                                            <td colspan="2">
                                                @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> drop_date) as $row)
                                                    - <i>{{ $row }}</i> <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                    @if(\App\Models\Environment::find($task-> environment) -> build !=null)
                                        <tr>
                                            <td width="20%">Builds</td>
                                            <td colspan="2">
                                                @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> build) as $row)
                                                    - <i>{{ $row }}</i> <br>
                                                @endforeach
                                            </td>
                                        </tr>

                                    @endif
                                    @if(\App\Models\Environment::find($task-> environment) -> device !=null)
                                        <tr>
                                            <td width="20%">Devices</td>
                                            <td colspan="2">
                                                @foreach(explode(';',\App\Models\Environment::find($task-> environment) -> device) as $row)
                                                    - <i>{{ $row }}</i> <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>

                                </table>
                            @else
                                <table class="mt-2 table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Environments</th>
                                        <th style="width: 20px">
                                            <div class="d-flex mr-auto order-actions">
                                                <a href="{{ route('manager.add.env',$task->id) }}"
                                                   title="Add env" class=""><i
                                                        class='bx bxs-plus-circle text-primary'></i></a>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="3">No Environment added</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif
                        @endif
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
                                    <input type="text" name="contents" class="form-control"
                                           placeholder="Type message"
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
