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
                        <li class="breadcrumb-item active" aria-current="page">All Project</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>Updated at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($projects as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->desc }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>
                                    @if($item->updated_at !=null)
                                        {{ $item->updated_at }}
                                    @else
                                        {{ $item->created_at }}
                                    @endif

                                </td>
                                <td> @if ($item->status == 1)
                                        <span class="badge bg-success">Active </span>
                                    @else
                                        <span class="badge bg-danger">InActive </span>
                                    @endif
                                </td>
                                <td>
{{--                                    <div class="col">--}}
{{--                                        <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                            <a href="{{ route('manager.all.boards',$item->id) }}" type="button"--}}
{{--                                               class="btn btn-secondary"><i class="bx bxs-food-menu"></i>--}}
{{--                                            </a>--}}
{{--                                            <a href="{{ route('manager.add.board',$item->id) }}" type="button"--}}
{{--                                               class="btn btn-secondary"><i class="bx bxs-add-to-queue"></i>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col">
                                        <div class="btn-group">
                                            <a type="button" href="{{ route('manager.all.boards',$item->id) }}" class="btn btn-outline-secondary">View Board</a>
                                            <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">	<span class="visually-hidden">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('manager.add.board',$item->id) }}">Details</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#">Another action</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#">Something else here</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="#">Separated link</a>
                                                </li>
                                            </ul>
                                        </div>
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
