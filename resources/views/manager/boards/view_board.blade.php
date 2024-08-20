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
                        <li class="breadcrumb-item active" aria-current="page">{{$board -> name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('manager.add.task',$board->id) }}" type="button" class="btn btn-info px-5"><i
                            class='bx bx-add-to-queue mr-1'></i>Add Task</a>
                </div>
{{--                <div class="btn-group">--}}
{{--                    @if($board -> board_config_id == null)--}}
{{--                    <a type="button" href="{{route('manager.config.board', $board -> id)}}" class="btn btn-primary">Config</a>--}}
{{--                    @else--}}
{{--                    <a type="button" href="{{route('manager.edit.config.board', $board -> id)}}" class="btn btn-primary">Edit Config</a>--}}
{{--                    @endif--}}
{{--                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"--}}
{{--                            data-bs-toggle="dropdown"><span class="visually-hidden">Toggle Dropdown</span>--}}
{{--                    </button>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"><a class="dropdown-item"--}}
{{--                                                                                           href="javascript:;">Action</a>--}}
{{--                        <a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                        <a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <a class="dropdown-item" href="javascript:;">Separated link</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
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
            <hr/>
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
                                                            {{ $item->jira_id }}
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
                                                            <a target="_blank" href=" {{ $item->link_to_result }}">Link To Result</a>

                                                        @endif
                                                    </td>
                                                @endif
                                                @if($board_config-> test_plan != 0)
                                                    <td>
                                                        @if($item-> test_plan !=null)
                                                            <a target="_blank" href="{{ $item->test_plan }}">Test Plan</a>
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

                    </div>
                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        <div>
                            <div lang="EN-US" link="#0563C1" vlink="#954F72">
                                <div class="x_WordSection1">
                                    <p class="x_MsoNormal" style="background:white"><a name="x__Hlk155304048" target="_blank" rel="noopener noreferrer"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;">Hi Roger,</span></a><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;">Below is our status report for today. Please review and let us know if you have any comments or questions.</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;">Summary:</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <table class="x_MsoNormalTable" border="0" cellspacing="0" cellpadding="0" style="background:white; border-collapse:collapse; caption-side:bottom; orphans:2; text-align:start; widows:2; word-spacing:0px">
                                        <tbody>
                                        <tr style="height:15.0pt">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Initial Configuration</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">2</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">0</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#DCE6F1; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">1</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">App Core</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">1</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">2</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#F2DCDB; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">0</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Content Experience</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">2</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">1</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#E4DFEC; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">1</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Continuous Configuration</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">4</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">0</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">0</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Playback Control</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">1</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">1</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#FDE9D9; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">0</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Pro-Infrastructure</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">0</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">1</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#EBF1DE; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">3</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Pinewood</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">1</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">0</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#F4B083; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">4</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Home Audio Embedded</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">0</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">1</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        <tr style="height:15.0pt; border-color:inherit">
                                            <td width="189" nowrap="" valign="bottom" style="width:141.75pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                            </td>
                                            <td width="134" nowrap="" valign="bottom" style="width:100.25pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span><span style="font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="107" nowrap="" valign="bottom" style="width:80.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                            <td width="64" nowrap="" style="width:48.0pt; background:#DAEEF3; padding:0in 5.4pt 0in 5.4pt; height:15.0pt; border-color:inherit">
                                                <p class="x_MsoNormal" align="center" style="text-align:center"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">0</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;">Details of the assignment:</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(0, 112, 192); font-family: Calibri, sans-serif, serif, EmojiFont;">Initial Configuration</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-14797" target="_blank" rel="noopener noreferrer">PMA-14797</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [iOS] Failed to add player running 78.1-52020 firmware to HH</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-14735" target="_blank" rel="noopener noreferrer">PMA-14735</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [iOS] Add product wizard does not remove discovered product if it is just added to HH</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-16156" target="_blank" rel="noopener noreferrer">PMA-16156</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Android] Sub (Vertigo) force to AP connect</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(0, 112, 192); font-family: Calibri, sans-serif, serif, EmojiFont;">App Core</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-12610" target="_blank" rel="noopener noreferrer">PMA-12610</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Android] Google Backup causes "unexpected" behavior on uninstall/reinstall</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-15668" target="_blank" rel="noopener noreferrer">PMA-15668</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Agest] S1 Regression test pass on iOS 18 Public Beta</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-15669" target="_blank" rel="noopener noreferrer">PMA-15669</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Agest] S1 regression test pass on Android 15 Beta</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(0, 112, 192); font-family: Calibri, sans-serif, serif, EmojiFont;">Content Experience</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-15783" target="_blank" rel="noopener noreferrer">PMA-15783</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [iOS][Recently Played] In the new HH, the "Use Personalization Services" toggle switch will automatically turn off after rebooting the app</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-15909" target="_blank" rel="noopener noreferrer">PMA-15909</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Test Cases][iOS] Sonos Radio Swimlanes Are Not Pre-Populated</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-16158" target="_blank" rel="noopener noreferrer">PMA-16158</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- 2024 Sprint 15 - Content Everywhere MSP Scenarios Run</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-16140" target="_blank" rel="noopener noreferrer">PMA-16140</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Android] Unable to start playback on Passport - Bom 0.69.4 and higher</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(0, 112, 192); font-family: Calibri, sans-serif, serif, EmojiFont;">Continuous Configuration</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-15813" target="_blank" rel="noopener noreferrer">PMA-15813</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Android] [Group] Save button still enabled without selected room in Groups</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-13429" target="_blank" rel="noopener noreferrer">PMA-13429</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [iOS][Passport/Lasso] - Wi-Fi connection stats are inconsistent</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-10671" target="_blank" rel="noopener noreferrer">PMA-10671</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Android] [System Settings] Left alignment doesn't match with design</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-16131" target="_blank" rel="noopener noreferrer">PMA-16131</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [iOS] [Alarm] Sonos Chime plays when setting the music service for alarm</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(0, 112, 192); font-family: Calibri, sans-serif, serif, EmojiFont;">Playback Control</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-14061" target="_blank" rel="noopener noreferrer">PMA-14061</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- Android: Upgrade MenuTextFieldView to M3</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-14060" target="_blank" rel="noopener noreferrer">PMA-14060</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- Android: Refactor and replace M1 BottomSheet with M3 Bottom Sheet - full regression test</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(0, 112, 192); font-family: Calibri, sans-serif, serif, EmojiFont;">Pro-Infrastructure</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/SWPBL-215583" target="_blank" rel="noopener noreferrer">SWPBL-215583</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Android] Room Settings support for multiple line-in devices</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/SWPBL-233735" target="_blank" rel="noopener noreferrer">SWPBL-233735</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [iOS] Chime icon in Area Zone set wrong position</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/SWPBL-233736" target="_blank" rel="noopener noreferrer">SWPBL-233736</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [iOS][Android] Missing Connected/Not Connected text at Sources page</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/SWPBL-233738" target="_blank" rel="noopener noreferrer">SWPBL-233738</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- [Android] [Android] Missing "Sources" button for Stereo pair</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(0, 112, 192); font-family: Calibri, sans-serif, serif, EmojiFont;">Pinewood</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Done</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PINE-3529" target="_blank" rel="noopener noreferrer">PINE-3529</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- Pinewood BVT build NSUD 359</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Bug found</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Open</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PINE-3530" target="_blank" rel="noopener noreferrer">PINE-3530</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- Missing Movie Details option when opening Up Next Content</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PINE-3531" target="_blank" rel="noopener noreferrer">PINE-3531</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- Pluto Live TV is added to Up Next after watching live TV channel</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PINE-3532" target="_blank" rel="noopener noreferrer">PINE-3532</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- The text " OTA Update" is cut off when moving from Up Next to Source Row</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PINE-3534" target="_blank" rel="noopener noreferrer">PINE-3534</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- The sound is dropped when switching the 'Up Next' content from app 1 to app 2</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><b><span style="font-size: 14pt; color: rgb(0, 112, 192); font-family: Calibri, sans-serif, serif, EmojiFont;">Home Audio Embedded</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:14.0pt; background:white"><b><span style="font-size: 14pt; color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">Testing request</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:22.0pt; background:white"><b><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">In-progress</span></b><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="text-indent:33.0pt; background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;"><a href="https://jira.sonos.com/browse/PMA-15068" target="_blank" rel="noopener noreferrer">PMA-15068</a></span><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;- Passport/Player Performance Testing - App</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: black; font-family: Calibri, sans-serif, serif, EmojiFont;">&nbsp;</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                    <p class="x_MsoNormal" style="background:white"><span style="color: rgb(33, 37, 41); font-family: Calibri, sans-serif, serif, EmojiFont;">Thank you and best regards,</span><span style="font-family: &quot;Segoe UI&quot;, sans-serif, serif, EmojiFont; color: rgb(33, 37, 41);"></span></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" action="{{ route('manager.update-board-config') }}" method="post" class="row g-3"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <h5 class="mb-4">Board Config</h5>
                                        <input type="hidden" name="board_config_id" value="{{$board_config -> id}}">
                                        <div class="row mb-3">
                                            <label for="project_name" class="col-sm-3 col-form-label">Board Name</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative input-icon">
                                                    <input type="text" class="form-control" disabled value="{{$board ->name}}"  id="board_name">
                                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Team</label>
                                            <div class="col-sm-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> team == 1 ? 'checked': ''}} type="radio" name="team" id="team1" value="1">
                                                    <label class="form-check-label" for="team1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> team == 0 ? 'checked': ''}} type="radio" name="team" id="team0" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> type == 1 ? 'checked': ''}} type="radio" name="type" id="type1" value="1">
                                                    <label class="form-check-label" for="type1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> type == 0 ? 'checked': ''}} type="radio" name="type" id="type0" value="0">
                                                    <label class="form-check-label"  for="type0">Disable</label>
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
                                                    <input class="form-check-input" {{$board_config -> jira_id == 1 ? 'checked': ''}} type="radio" name="jira_id" id="jira_id1" value="1">
                                                    <label class="form-check-label" for="jira_id1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> jira_id == 0 ? 'checked': ''}} type="radio" name="jira_id" id="jira_id0" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> jira_summary == 1 ? 'checked': ''}} type="radio" name="jira_summary" id="jira_summary1" value="1">
                                                    <label class="form-check-label" for="jira_summary1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> jira_summary == 0 ? 'checked': ''}} type="radio" name="jira_summary" id="jira_summary0" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> working_status == 1 ? 'checked': ''}} type="radio" name="working_status" id="working_status1" value="1">
                                                    <label class="form-check-label" for="working_status1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> working_status == 0 ? 'checked': ''}} type="radio" name="working_status" id="working_status0" value="0">
                                                    <label class="form-check-label" for="working_status0">Disable</label>
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
                                                    <input class="form-check-input" {{$board_config -> ticket_status == 1 ? 'checked': ''}} type="radio" name="ticket_status" id="ticket_status1" value="1">
                                                    <label class="form-check-label" for="ticket_status1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> ticket_status == 0 ? 'checked': ''}} type="radio" name="ticket_status" id="ticket_status0" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> priority == 1 ? 'checked': ''}} checked type="radio" name="priority" id="priority1" value="1">
                                                    <label class="form-check-label" for="ticket_status1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"  {{$board_config -> priority == 0 ? 'checked': ''}} type="radio" name="priority" id="priority0" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> link_to_result == 1 ? 'checked': ''}} type="radio" name="link_to_result" id="link_to_result1" value="1">
                                                    <label class="form-check-label" for="link_to_result1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> link_to_result == 0 ? 'checked': ''}} type="radio" name="link_to_result" id="link_to_result0" value="0">
                                                    <label class="form-check-label" for="link_to_result0">Disable</label>
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
                                                    <input class="form-check-input" {{$board_config -> test_plan == 1 ? 'checked': ''}} type="radio" name="test_plan" id="test_plan1" value="1">
                                                    <label class="form-check-label" for="test_plan1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> test_plan == 0 ? 'checked': ''}} type="radio" name="test_plan" id="test_plan0" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> sprint == 1 ? 'checked': ''}} type="radio" name="sprint" id="sprint1" value="1">
                                                    <label class="form-check-label" for="sprint1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> sprint == 0 ? 'checked': ''}} type="radio" name="sprint" id="sprint0" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> note == 1 ? 'checked': ''}} type="radio" name="note" id="note1" value="1">
                                                    <label class="form-check-label" for="note1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> note == 0 ? 'checked': ''}} type="radio" name="note" id="note0" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> tester_1 == 1 ? 'checked': ''}} type="radio" name="tester_1" id="tester_11" value="1">
                                                    <label class="form-check-label" for="tester_11">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> tester_1 == 0 ? 'checked': ''}} type="radio" name="tester_1" id="tester_10" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> tester_2 == 1 ? 'checked': ''}} type="radio" name="tester_2" id="tester_21" value="1">
                                                    <label class="form-check-label" for="tester_21">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> tester_2 == 0 ? 'checked': ''}} type="radio" name="tester_2" id="tester_20" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> tester_3 == 1 ? 'checked': ''}} type="radio" name="tester_3" id="tester_31" value="1">
                                                    <label class="form-check-label" for="tester_31">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> tester_3 == 0 ? 'checked': ''}} type="radio" name="tester_3" id="tester_30" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> tester_4 == 1 ? 'checked': ''}} type="radio" name="tester_4" id="tester_41" value="1">
                                                    <label class="form-check-label" for="tester_41">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> tester_4 == 0 ? 'checked': ''}} type="radio" name="tester_4" id="tester_40" value="0">
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
                                                    <input class="form-check-input" {{$board_config -> tester_5 == 1 ? 'checked': ''}} type="radio" name="tester_5" id="tester_51" value="1">
                                                    <label class="form-check-label" for="tester_51">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{$board_config -> tester_5 == 0 ? 'checked': ''}} type="radio" name="tester_5" id="tester_50" value="0">
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
