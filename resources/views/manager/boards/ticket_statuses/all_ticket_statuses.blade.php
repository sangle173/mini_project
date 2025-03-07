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
        <div class=" d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Ticket Statuses</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('manager.add.boardticket_status') }}" type="button" class="btn btn-info px-5"><i
                            class='bx bx-add-to-queue mr-1'></i>Add Ticket Status</a>
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
                            <th>Ticket Status Name</th>
                            <th>Color</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($ticket_statuses as $key=> $item)
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
                                    <div class="d-flex order-actions">
                                        {{--                                        <a href="{{ route('manager.all.boards',$item->id) }}" title="Edit" class=""><i class='lni lni-eye text-success'></i></a>--}}
                                        {{--                                        <a href="{{ route('manager.add.board',$item->id) }}" title="Add Board" class=""><i class='bx bxs-plus-square text-info'></i></a>--}}
                                        <a href="{{ route('manager.edit.boardticket_status',$item->id) }}" title="Edit"
                                           class=""><i
                                                class='bx bxs-edit text-primary'></i></a>
                                        @if(Auth::user()->role ==='admin')
                                            <a href="{{ route('manager.delete.boardticket_status',$item->id) }}"
                                               id="delete"
                                               title="Delete" class=""><i class='bx bxs-trash text-danger'></i></a>
                                        @endif
                                    </div>
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
