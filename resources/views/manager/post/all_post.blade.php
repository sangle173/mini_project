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
                    <li class="breadcrumb-item active" aria-current="page">All Blogs</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.blog.post') }}" class="btn btn-purple px-4">Add Blog</a>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Attachments</th>
                        <th>Tags</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($post as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{ route('view.post',$item->id) }}"
                                   title="View" class="">{{ $item->post_title }}</a></td>
                            <td>{{ $item['blog']['category_name'] }}</td>
                            <td><a href="{{ asset($item->post_image) }}" target="_blank">{{$item->post_image}}</a></td>
                            <td>{{$item -> post_tags}}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('view.post',$item->id) }}"
                                       title="View" class=""><i
                                            class='lni lni-eye text-success'></i></a>
                                    @auth()
                                        @if(Auth::user()->role ==='manager' || Auth::user() -> id == $item -> tester_1 )
                                            <a href="{{ route('edit.post',$item->id) }}"
                                               title="Edit" class=""><i
                                                    class='bx bxs-edit text-primary'></i></a>
                                        @endif
                                        @if(Auth::user()->role ==='manager' || Auth::user() -> id == $item -> tester_1 )
                                            <a href="{{ route('delete.post',$item->id) }}"
                                               id="delete"
                                               title="delete" class=""><i
                                                    class='bx bxs-trash text-danger'></i></a>
                                        @endif
                                    @endauth
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


@endsection
