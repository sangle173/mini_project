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
{{--                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('manager.all.boards',$board-> project_id) }}">{{\App\Models\Board::getProjectById($board-> project_id)-> name}} Project</a></li>--}}
                        <li class="breadcrumb-item active" aria-current="page">All Board</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('manager.add.board') }}" type="button" class="btn btn-info px-5"><i
                            class='bx bx-add-to-queue mr-1'></i>Add Board</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-4 row-cols-xl-4    ">
            @foreach ($boards as $key=> $item)
            <div class="col">
                <div class="card">
                    <a href="{{route('manager.show.board', $item -> id)}}"><img src="{{ asset($item->photo) }}" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">{{$item ->name}}</h5>
                        <p class="card-text">{{$item -> title}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Total task</li>
                        <li class="list-group-item">Bug found</li>
                        <li class="list-group-item">Testing Request </li>
                    </ul>
                    <div class="card-body">
{{--                        <a href="{{ route('manager.all.boardteams', $item -> id) }}" class="card-link">Config</a>--}}
                        <div class="col">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Board Config</button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('manager.all.boardteams', $item -> id) }}">Manage Team</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('manager.all.boardtypes', $item -> id) }}">Manage Type</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('manager.all.boardworking_statuses', $item -> id) }}">Manage Working Status</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('manager.all.boardticket_statuses', $item -> id) }}">Manage Ticket Status</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('manager.all.boardpriorities', $item -> id) }}">Manage Priority</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('manager.all.tasks', $item -> id) }}">Manage Task</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('manager.config.board', $item -> id) }}">Board Config</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--end row-->

    </div>

@endsection
