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
                    <form id="myForm2" action="{{ route('manager.task.export') }}" method="get">
                        <input type="hidden" value="{{$tasks}}" name="tasks">
                        <button type="submit" class="btn btn-info px-3"><i
                                class='bx bxs-file-export mr-1'></i>Export-Excel
                        </button>
                    </form>
                    <form id="myForm2" style="margin-left: 2px" action="{{ route('manager.task.export.html') }}" method="get">
                        <input type="hidden" value="{{$tasks}}" name="tasks">
                        <button type="submit" class="btn btn-secondary px-3"><i
                                class='bx bxs-file-html mr-1'></i>Export-Html
                        </button>
                    </form>
                    <form id="myForm2" style="margin-left: 2px" action="{{ route('manager.task.export.pdf') }}" method="get">
                        <input type="hidden" value="{{$tasks}}" name="tasks">
                        <button type="submit" class="btn btn-danger px-3"><i
                                class='bx bxs-file-pdf mr-1'></i>Export-PDF
                        </button>
                    </form>
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
                                <form id="myForm" action="{{ route('manager.task.filter') }}" method="get">
                                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane"
                                         aria-labelledby="stepper1trigger1">
                                        {{--                            <input type="hidden" name="board_id" value="{{$board-> id}}">--}}
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
                                                <label for="team" class="form-label"><b>Board</b></label>
                                                <div class="form-check">
                                                    @foreach ($boards as $board)
                                                        @if(isset($request))
                                                            <input class="form-check-input" name="board[]"
                                                                   type="checkbox"
                                                                   {{in_array($board->id, $request -> board ) && count($request -> board) != count($boards)? 'checked':''}}  value="{{ $board->id }}"
                                                                   id="type{{ $board->id }}">
                                                            <label class="form-check-label">
                                                                {{ $board->name }}
                                                            </label> <br>
                                                        @else
                                                            <input class="form-check-input" name="team[]"
                                                                   type="checkbox"
                                                                   value="{{ $board->id }}"
                                                                   id="type{{ $board->id }}">
                                                            <label class="form-check-label">
                                                                {{ $board->name }}
                                                            </label> <br>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
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
                                                <a href="{{route('manager.tasks')}}"
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


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
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
                                    {{ $item->jira_id }}
                                </td>
                                <td>
                                    {{ $item->jira_summary }}
                                </td>
                                <td>
                                    @if($item-> working_status !=null)
                                        {{\App\Models\WorkingStatus::find($item-> working_status) -> name}}
                                    @endif
                                </td>
                                <td>
                                    @if($item-> ticket_status !=null)
                                        {{\App\Models\TicketStatus::find($item-> ticket_status) -> name}}
                                    @endif
                                </td>
                                <td>
                                    @if($item-> priority !=null)
                                        {{\App\Models\Priority::find($item-> priority) -> name}}
                                    @endif
                                </td>
                                <td>
                                    <a target="_blank" href=" {{ $item->link_to_result }}">Link To Result</a>
                                </td>
                                <td>
                                    <a target="_blank" href="{{ $item->test_plan }}">Test Plan</a>
                                </td>
                                <td>
                                    {{ $item->sprint }}
                                </td>
                                <td>
                                    {{ $item->note }}
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
