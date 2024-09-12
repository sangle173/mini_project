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
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager.all.boards')}}">All Board</a></li>
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
                                        <h4 class="my-1 text-white">{{count($tasks)}}</h4>
                                        <p class="mb-0 font-13 text-white">+2.5% from yesterday</p>
                                    </div>
                                    <div id="chart1"></div>
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
                                        <h4 class="my-1 text-white">{{count($tasks)}}</h4>
                                        <p class="mb-0 font-13 text-white">-4.5% from yesterday</p>
                                    </div>
                                    <div id="chart3"></div>
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
                                        <h4 class="my-1 text-dark">2</h4>
                                        <p class="mb-0 font-13 text-dark">+8.4% from yesterday</p>
                                    </div>
                                    <div id="chart4"></div>
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
                                        <h4 class="my-1 text-white">10</h4>
                                        <p class="mb-0 font-13 text-white">+5.4% from yesterday</p>
                                    </div>
                                    <div id="chart2"></div>
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
                                    <form onSubmit="return false">
                                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane"
                                             aria-labelledby="stepper1trigger1">
                                            <div class="row g-3">
                                                <div class="col-12 col-lg-2">
                                                    <label for="type" class="form-label">Type</label>
                                                    <select class="form-select" name="type" id="type">
                                                        <option selected="">-------</option>
                                                        @foreach ($types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="team" class="form-label">Team</label>
                                                    <select class="form-select" name="team" id="team">
                                                        <option selected="">-------</option>
                                                        @foreach ($teams as $team)
                                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="working_status" class="form-label">Working
                                                        Status</label>
                                                    <select class="form-select" name="working_status"
                                                            id="working_status">
                                                        <option selected="">-------</option>
                                                        @foreach ($working_statuses as $working_status)
                                                            <option
                                                                value="{{ $working_status->id }}">{{ $working_status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="ticket_status" class="form-label">Ticket Status</label>
                                                    <select class="form-select" name="ticket_status" id="ticket_status">
                                                        <option selected="">-------</option>
                                                        @foreach ($ticket_statuses as $ticket_status)
                                                            <option
                                                                value="{{ $ticket_status->id }}">{{ $ticket_status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="priority" class="form-label">Priority</label>
                                                    <select class="form-select" name="priority" id="priority">
                                                        <option selected="">-------</option>
                                                        @foreach ($priorities as $priority)
                                                            <option
                                                                value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <label for="tester" class="form-label">Tester</label>
                                                    <select class="form-select" name="tester" id="tester_1">
                                                        <option selected="">-------</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div><!---end row-->
                                            <div class="row mt-1 g-3">
                                                <div class="col-12 col-lg-6">
                                                    <button class="btn btn-secondary px-4" type="reset">
                                                        Reset
                                                    </button>
                                                    <button class="btn btn-primary px-4" onclick="stepper1.next()">
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
                                <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                                   aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-cog font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">Config</div>
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
                                                    <td>
                                                        @if($item-> team !=null)
                                                            {{\App\Models\Team::find($item-> team) -> name}}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> type != 0)
                                                    <td>
                                                        @if($item-> type !=null)
                                                            {{\App\Models\Type::find($item-> type) -> name}}
                                                        @endif
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
                                                        @if($item-> working_status !=null)
                                                            {{\App\Models\WorkingStatus::find($item-> working_status) -> name}}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> ticket_status != 0)
                                                    <td>
                                                        @if($item-> ticket_status !=null)
                                                            {{\App\Models\TicketStatus::find($item-> ticket_status) -> name}}
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
                                                        <a href="{{ route('manager.edit.task',$item->id) }}"
                                                           title="View" class=""><i
                                                                class='lni lni-eye text-success'></i></a>
                                                        <a href="{{ route('manager.clone.task',$item->id) }}"
                                                           title="Clone" class=""><i
                                                                class='bx bxs-copy text-success'></i></a>
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


@endsection
