@extends('admin.admin_dashboard')
@section('admin')
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
                        <li class="breadcrumb-item active" aria-current="page">All Users</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.add.users') }}" type="button" class="btn btn-info px-5"><i class='bx bx-user-plus mr-1'></i>Add User</a>
                </div>
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
                            <th>Manager Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Title</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($allusers as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->phone }}</td>

                                <td> @if ($item->role == 'admin')
                                        <span class="badge bg-primary">Admin</span>
                                    @elseif($item->role == 'manager')
                                        <span class="badge bg-info">Manager</span>
                                    @else
                                        <span class="badge bg-secondary">Employee</span>
                                    @endif
                                </td>
                                <td> @if ($item->status == 1)
                                        <span class="badge bg-success">Active </span>
                                    @else
                                        <span class="badge bg-danger">InActive </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="form-check-danger form-check form-switch">
                                        <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                               id="flexSwitchCheckCheckedDanger"
                                               data-user-id="{{ $item->id }}" {{ $item->status ? 'checked' : ''}} >
                                        <label class="form-check-label" for="flexSwitchCheckCheckedDanger"> </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-secondary"><i class="bx bx-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-secondary"><i class="bx bx-share"></i>
                                            </button>
                                            <button type="button" class="btn btn-secondary"><i class="bx bx-trash"></i>
                                            </button>
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
                var userId = $(this).data('user-id');
                var isChecked = $(this).is(':checked');

                // send an ajax request to update status

                $.ajax({
                    url: "{{ route('admin.update.user.status') }}",
                    method: "POST",
                    data: {
                        user_id: userId,
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
