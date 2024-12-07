@extends('manager.manager_dashboard')
@section('users')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class=" d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bxs-home-circle"></i></a>
                        </li>
                        {{--                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager.show.board', $board -> id)}}">{{$board -> name}} Board</a></li>--}}
                        <li class="breadcrumb-item active" aria-current="page">Sprint Report</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="p-rich_text_block" dir="auto">
                    <div class="p-rich_text_section"><b data-stringify-type="bold">[SONOS] - Sprint Report - 2024
                            CoreEng-RVC-LG Sprint {{$sprint}}</b><br><br>
                        <b data-stringify-type="bold">I. SPRINT'S
                            ACCOMPLISHMENTS</b>
                        <br>
                        @foreach ($types as $key=> $item)
                            @if(count(\App\Models\Task::where('board_id', $board-> id) ->where('sprint', $sprint) -> where('type', $item -> id) -> latest() -> get()) !=0)
                                <div class="p-rich_text_section"><span aria-label="" class="c-mrkdwn__br"
                                                                       data-stringify-type="paragraph-break"></span><b
                                        data-stringify-type="bold">{{$key + 1}}. {{$item -> name}}</b><br></div>
                                <ul data-stringify-type="unordered-list" data-list-tree="true"
                                    class="p-rich_text_list p-rich_text_list__bullet p-rich_text_list--nested"
                                    data-indent="0"
                                    data-border="0">
                                    @foreach (\App\Models\Task::where('board_id', $board-> id) ->where('sprint', $sprint) -> where('type', $item -> id) -> orderBy('jira_id', 'ASC') -> latest() -> get() as $key=> $row)
                                        <li data-stringify-indent="0" data-stringify-border="0"><a target="_blank"
                                                                                                   class="c-link"
                                                                                                   data-stringify-link="{{url('https://jira.sonos.com/browse/'.$row -> jira_id)}}"
                                                                                                   delay="150"
                                                                                                   data-sk="tooltip_parent"
                                                                                                   href="{{url('https://jira.sonos.com/browse/'.$row -> jira_id)}}"
                                                                                                   rel="noopener noreferrer">{{$row -> jira_id}}</a>
                                            - {{$row -> jira_summary}}:
                                            <b>{{strtoupper(\App\Models\TicketStatus::find($row -> ticket_status) -> name)}}</b>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach

                        <b data-stringify-type="bold">II. BUGS FOUND</b>
                        <br>
                        @foreach ($types as $key=> $item)
                            @if(count(\App\Models\Task::where('board_id', $board-> id) ->where('sprint', $sprint) -> where('type', $item -> id) -> latest() -> get()) !=0)
                                <div class="p-rich_text_section"><span aria-label="" class="c-mrkdwn__br"
                                                                       data-stringify-type="paragraph-break"></span><b
                                        data-stringify-type="bold">{{$key + 1}}. {{$item -> name}}</b><br></div>
                                <ul data-stringify-type="unordered-list" data-list-tree="true"
                                    class="p-rich_text_list p-rich_text_list__bullet p-rich_text_list--nested"
                                    data-indent="0"
                                    data-border="0">
                                    @foreach (\App\Models\Task::where('board_id', $board-> id) ->where('sprint', $sprint) -> where('type', $item -> id) -> latest() -> get() as $key=> $row)
                                        @foreach (\App\Models\Task::where('parent_task_id', $row-> id) -> latest() -> get() as $key=> $row2)
                                        <li data-stringify-indent="0" data-stringify-border="0"><a target="_blank"
                                                                                                   class="c-link"
                                                                                                   data-stringify-link="{{url('https://jira.sonos.com/browse/'.$row2 -> jira_id)}}"
                                                                                                   delay="150"
                                                                                                   data-sk="tooltip_parent"
                                                                                                   href="{{url('https://jira.sonos.com/browse/'.$row2 -> jira_id)}}"
                                                                                                   rel="noopener noreferrer">{{$row2 -> jira_id}}</a>
                                            - {{$row2 -> jira_summary}}
                                        </li>
                                    @endforeach
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                        <div class="p-rich_text_section"><span aria-label="" class="c-mrkdwn__br"
                                                               data-stringify-type="paragraph-break"></span><b
                                data-stringify-type="bold">
                                III.
                                Question/ Issue:</b><span aria-label="" class="c-mrkdwn__br"
                                                                                    data-stringify-type="paragraph-break"></span><b
                                data-stringify-type="bold"><br><br>IV. Note:</b><br><span aria-label="" class="c-mrkdwn__br"
                                                                              data-stringify-type="paragraph-break"></span><b
                                data-stringify-type="bold"><br>V. TO DO SPRINT 22: Continue work on Passport MA3 and
                                SVC.</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
