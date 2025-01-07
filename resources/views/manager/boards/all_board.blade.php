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
        <div class="d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bxs-home-circle"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Boards</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    @auth()
                        @if(Auth::user()->role ==='manager')

                            <a href="{{ route('manager.add.board') }}" type="button"
                               style="background-color: #754FFE;color: white" class="btn px-5"><i
                                    class='bx bx-add-to-queue mr-1'></i>Add Boards</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-4 row-cols-xl-4">
                @foreach ($boards as $key=> $item)
                    <div class="col">
                        <div class="card border-primary border-bottom border-0">
                            <a href="{{route('manager.show.board', $item -> id)}}"><img src="{{ asset($item->photo) }}"
                                                                                        class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <a href="{{route('manager.show.board', $item -> id)}}"><h5
                                        class="card-title text-primary">{{$item -> name}}</h5></a>
                                <p class="card-text">{{$item -> title}}</p>
                                <hr>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center"><span><i
                                                class='bx bx-task text-primary font-18 align-middle me-1'></i> Total Task</span>
                                        <span
                                            class="badge bg-secondary rounded-pill"> {{count(\App\Models\Task::where('board_id', $item->id)->whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"><span><i
                                                class='bx bx-store text-success font-18 align-middle me-1'></i> Completed</span>
                                        <span
                                            class="badge bg-success rounded-pill">{{count(\App\Models\Task::where('board_id', $item->id)->where('working_status', 2 ) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"><span><i
                                                class='bx bx-loader-circle text-primary font-18 align-middle me-1'></i> In-progress</span>
                                        <span
                                            class="badge bg-primary rounded-pill">{{count(\App\Models\Task::where('board_id', $item->id)->where('working_status', 1 ) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"><span><i
                                                class='bx bxs-bug text-danger font-18 align-middle me-1'></i> Bug Found</span>
                                        <span
                                            class="badge bg-danger rounded-pill">{{count(\App\Models\Task::where('board_id', $item->id)->where('type', 1 ) -> whereDate('created_at', \Illuminate\Support\Carbon::today())->latest()->get())}}</span>
                                    </li>
                                </ul>
                                <br>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('tasks.filter', $item -> id) }}"
                                       class="btn" style="background-color: #FFE800">View Board</a>
                                    @auth

                                        @if(Auth::user()->role ==='manager')
                                            <div class="dropdown">
                                                <button class="btn btn-inverse-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">Board Config
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="{{ route('manager.edit.config.board', $item -> id) }}">Board
                                                            Config</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-primary"
                                                           href="{{ route('manager.edit.board', $item -> id) }}">Edit
                                                            Board</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--end row-->
        </div>
    </div>

@endsection
