@extends('manager.manager_dashboard')
@section('users')

@section('title')
    Blog
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Notes</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.note') }}" class="btn btn-purple px-4">Add Note</a>
            </div>
        </div>
    </div>

</div>

<!--end breadcrumb-->
<div class="row">
    <!--start email wrapper-->
    <div class="col-md-4">
        <div class="table-responsive">
            <table data-page-length='25' id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Note Title</th>
                    <th>Update at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($notes as $key=> $item)
                    <tr>
                        <td width="2%">{{$key + 1}}</td>
                        <td><a href="{{route('view.note', $item -> id)}}">{{$item -> title}}</a></td>
                        <td width="15%">
                            @if($item -> updated_at != null)
                                {{$item -> updated_at}}
                            @else
                                {{$item -> created_at}}
                            @endif
                        </td>
                        <td width="5%">
                            <a href="{{ route('edit.note',$item->id) }}"
                               title="Edit" class=""><i
                                    class='bx bxs-edit text-primary'></i></a>
                            <a href="{{ route('delete.note',$item->id) }}"
                               id="delete"
                               title="Delete" class=""><i
                                    class='bx bxs-trash text-danger'></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-8">
        @if(isset($note))
            @if($note != null)
                {!! $note -> content !!}
            @endif
        @endif
    </div>
    <!--end email wrapper-->
</div>
@endsection
