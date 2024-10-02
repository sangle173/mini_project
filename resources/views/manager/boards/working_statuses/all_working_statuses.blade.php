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
                        <li class="breadcrumb-item active" aria-current="page">Working Statuses</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('manager.add.boardworking_status') }}" type="button" class="btn btn-info px-5"><i
                            class='bx bx-add-to-queue mr-1'></i>Add Working Status</a>
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
                            <th>Working Status Name</th>
                            <th>Desc</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($working_statuses as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>{{ $item->desc }}</td>
                                <td>
                                    @if($item->updated_at !=null)
                                        {{ $item->updated_at }}
                                    @else
                                        {{ $item->created_at }}
                                    @endif
                                </td>
                                <td>
{{--                                    <a href="{{ route('course.all.lecture',$item->id) }}" class="btn btn-warning"--}}
{{--                                       title="Tất cả bài học"><i class="lni lni-list"></i> </a>--}}

                                    <a href="{{ route('manager.edit.boardworking_status',$item->id) }}" class="btn btn-info"
                                       title="Edit"><i
                                            class="lni lni-eraser"></i> </a>
{{--                                    <a href="{{ route('instructor.course.details',$item->id) }}" class="btn btn-success"><i--}}
{{--                                            class="lni lni-eye"></i></a>--}}

                                    <a href="{{ route('manager.delete.boardworking_status',$item->id) }}" class="btn btn-danger"
                                       id="delete"
                                       title="Delete"><i class="lni lni-trash"></i> </a>

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
