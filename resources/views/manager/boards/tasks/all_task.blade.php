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
        <div class=" d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Tasks</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Filter Tasks</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <form id="myForm2" action="{{ route('manager.task.export') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$tasks}}" name="tasks">
                        @if(isset($request))
                            <input type="hidden" value="{{$flag == 'on'? 1 : 0}}" name="flag"/>
                        @else
                            <input type="hidden" value="0" name="flag"/>
                        @endif

                        <button type="submit" class="btn btn-purple px-3"><i
                                class='bx bxs-file-export mr-1'></i>Export-Excel
                        </button>
                    </form>
                    {{--                    <form id="myForm2" style="margin-left: 2px" action="{{ route('manager.task.export.html') }}"--}}
                    {{--                          method="post" enctype="multipart/form-data">--}}
                    {{--                        @csrf--}}
                    {{--                        <input type="hidden" value="{{$tasks}}" name="tasks">--}}
                    {{--                        <button type="submit" class="btn btn-secondary px-3"><i--}}
                    {{--                                class='bx bxs-file-html mr-1'></i>Export-Html--}}
                    {{--                        </button>--}}
                    {{--                    </form>--}}
                    {{--                    <form id="myForm2" style="margin-left: 2px" action="{{ route('manager.task.export.pdf') }}"--}}
                    {{--                          method="get">--}}
                    {{--                        <input type="hidden" value="{{$tasks}}" name="tasks">--}}
                    {{--                        <button type="submit" class="btn btn-danger px-3"><i--}}
                    {{--                                class='bx bxs-file-pdf mr-1'></i>Export-PDF--}}
                    {{--                        </button>--}}
                    {{--                    </form>--}}
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span class="font-weight-bold">Search and Filter</span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body" style="background: #EEEEEE">
                            <div class="bs-stepper-content">
                                <form id="myForm" action="{{ route('manager.task.filter-export') }}" method="get">
                                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane"
                                         aria-labelledby="stepper1trigger1">
                                        <div class="row g-3">
                                            <div class="col-md-2">
                                                <label for="from_date" class="form-label">From Date</label>
                                                <div class="position-relative">
                                                    @if(isset($request))
                                                        <input type="date" value="{{$request -> from_date}}"
                                                               name="from_date"
                                                               class="form-control">
                                                    @else
                                                        <input class="form-control"
                                                               value="<?php echo date('Y-m-01'); ?>" type="date"
                                                               name="from_date">
                                                    @endif
                                                    @error('from_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="to_date" class="form-label">To Date</label>
                                                <div class="position-relative">
                                                    @if(isset($request))
                                                        <input type="date" value="{{$request -> to_date}}"
                                                               name="to_date"
                                                               class="form-control">
                                                    @else
                                                        <input class="form-control" value="<?php echo date('Y-m-t'); ?>"
                                                               type="date" name="to_date">
                                                    @endif
                                                    @error('to_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="board" class="form-label">Board</label>
                                                <div class="position-relative">
                                                    <select class="form-select" name="board" id="board">
                                                        <option disabled selected>Select Board</option>
                                                        @foreach ($boards as $board)
                                                            @if(isset($request))
                                                                <option
                                                                    value="{{ $board->id }}" {{ $board->id == $request-> board ? 'selected' : '' }}>{{ $board->id == $request-> board ? \App\Models\Board::find($request -> board) -> name : $board -> name}}</option>
                                                            @else
                                                                <option
                                                                    value="{{ $board->id }}">{{ $board->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="type" class="form-label">Type</label>
                                                <div class="position-relative">
                                                    <select class="form-select" name="type" id="type">
                                                        <option disabled selected>Select Type</option>
                                                        @foreach ($types as $type)
                                                            @if(isset($request))
                                                                <option
                                                                    value="{{ $type->id }}" {{ $type->id == $request-> type ? 'selected' : '' }}>{{ $type->id == $request-> type ? \App\Models\Type::find($request -> type) -> name : $type -> name}}</option>
                                                            @else
                                                                <option
                                                                    value="{{ $type->id }}">{{ $type->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="tester" class="form-label">Tester</label>
                                                <select class="form-select" name="tester" id="tester">
                                                    <option disabled selected>Select Tester</option>
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
                                                    *
                                                </label>
                                                <div class="position-relative input-icon">
                                                    <div class="form-check">
                                                        @if(isset($request))
                                                            <input class="form-check-input"
                                                                   {{$request -> unique_flag == 'on'? 'checked': '' }} name=unique_flag
                                                                   type="checkbox" id="unique_flag">
                                                        @else
                                                            <input class="form-check-input" name=unique_flag
                                                                   type="checkbox" id="unique_flag">
                                                        @endif
                                                        <label class="form-check-label" for="unique_flag">Remove
                                                            duplicate task</label>
                                                    </div>
                                                </div>
                                            </div><!---end row-->
                                        </div>
                                        <div class="row">
                                            <label for="input22" class="form-label">
                                                Filter
                                            </label>
                                            <div class="position-relative input-icon">
                                                <div class="col-md-12">
                                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                                        @if(isset($request))
                                                            <button type="submit" class="btn"
                                                                    style="background-color: #FFE800">Filtered
                                                            </button>
                                                        @else
                                                            <button type="submit" class="btn"
                                                                    style="background-color: #FFE800">Filter
                                                            </button>
                                                        @endif
                                                        <a href="{{route('manager.tasks', $board-> id)}}" --}}
                                                           class="btn btn-secondary" type="reset">
                                                            Reset
                                                        </a>
                                                    </div>
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


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table data-page-length='50' id="example" class="table table-striped table-bordered"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Task ID</th>
                            <th>Review?</th>
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
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge bg-success">Reviewed </span>
                                    @else
                                        <span class="badge bg-danger">Waiting </span>
                                    @endif
                                </td>
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
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
