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
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('manager.all.boards',$item->id) }}" title="Edit" class=""><i class='lni lni-eye text-success'></i></a>
                                        <a href="{{ route('manager.add.board',$item->id) }}" title="Add Board" class=""><i class='bx bxs-plus-square text-info'></i></a>
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
