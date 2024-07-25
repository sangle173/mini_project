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
                        <li class="breadcrumb-item active" aria-current="page">All Board</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('manager.add.board',$project->id) }}" type="button" class="btn btn-info px-5"><i
                            class='bx bx-add-to-queue mr-1'></i>Add Board</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <div class="table-responsive">--}}
{{--                    <table id="example" class="table table-striped table-bordered" style="width:100%">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>#</th>--}}
{{--                            <th>Board Name</th>--}}
{{--                            <th>Title</th>--}}
{{--                            <th>Description</th>--}}
{{--                            <th>Project</th>--}}
{{--                            <th>Start Date</th>--}}
{{--                            <th>Updated at</th>--}}
{{--                            <th>Status</th>--}}
{{--                            <th>Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}

{{--                        @foreach ($boards as $key=> $item)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $key+1 }}</td>--}}
{{--                                <td>--}}
{{--                                    {{ $item->name }}--}}
{{--                                </td>--}}
{{--                                <td>{{ $item->title }}</td>--}}
{{--                                <td>{{ $item->desc }}</td>--}}
{{--                                <td>{{ \App\Models\Board::getProjectById($item -> project_id) ->name }}</td>--}}
{{--                                <td>{{ $item->start_date }}</td>--}}
{{--                                <td>--}}
{{--                                    @if($item->updated_at !=null)--}}
{{--                                        {{ $item->updated_at }}--}}
{{--                                    @else--}}
{{--                                        {{ $item->created_at }}--}}
{{--                                    @endif--}}

{{--                                </td>--}}
{{--                                <td> @if ($item->status == 1)--}}
{{--                                        <span class="badge bg-success">Active </span>--}}
{{--                                    @else--}}
{{--                                        <span class="badge bg-danger">InActive </span>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>--}}

{{--                                    <div class="col">--}}
{{--                                        <div class="btn-group">--}}
{{--                                            <a type="button" href="{{ route('manager.all.boards',$item->id) }}"--}}
{{--                                               class="btn btn-outline-secondary">View Board</a>--}}
{{--                                            <button type="button"--}}
{{--                                                    class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"--}}
{{--                                                    data-bs-toggle="dropdown" aria-expanded="false"><span--}}
{{--                                                    class="visually-hidden">Toggle Dropdown</span>--}}
{{--                                            </button>--}}
{{--                                            <ul class="dropdown-menu">--}}
{{--                                                <li><a class="dropdown-item"--}}
{{--                                                       href="{{ route('manager.add.board',$item->id) }}">Add Board</a>--}}
{{--                                                </li>--}}
{{--                                                <li><a class="dropdown-item" href="#">Another action</a>--}}
{{--                                                </li>--}}
{{--                                                <li><a class="dropdown-item" href="#">Something else here</a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <hr class="dropdown-divider">--}}
{{--                                                </li>--}}
{{--                                                <li><a class="dropdown-item" href="#">Separated link</a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}

{{--                        </tbody>--}}

{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-4 row-cols-xl-4    ">
            @foreach ($boards as $key=> $item)
            <div class="col">
                <div class="card">
                    <img src="{{ asset($item->photo) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$item ->name}}</h5>
                        <p class="card-text">{{$item -> title}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Total task</li>
                        <li class="list-group-item">Bug found</li>
                        <li class="list-group-item">Testing Request </li>
                    </ul>
                    <div class="card-body">	<a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--end row-->

    </div>

    <script>
        $(document).ready(function () {
            $('.status-toggle').on('change', function () {
                var projectId = $(this).data('projects-id');
                var isChecked = $(this).is(':checked');

                // send an ajax request to update status

                $.ajax({
                    url: "{{ route('admin.update.projects.status') }}",
                    method: "POST",
                    data: {
                        project_id: projectId,
                        is_checked: isChecked ? 1 : 0,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        toastr.success(response.message);
                        window.setTimeout(function () {
                            location.reload();
                        }, 2000);

                    },
                    error: function () {

                    }
                });

            });
        });
    </script>


@endsection
