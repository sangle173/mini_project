@extends('manager.manager_dashboard')
@section('users')

@section('title')
    Blog
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Blog Post</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.blog.post') }}" class="btn btn-primary px-5">Add Blog Post </a>
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
                        <th>Sl</th>
                        <th>Post Title</th>
                        <th>Blog Category</th>
                        <th>Blog Image</th>
                        <th>Tags</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($post as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->post_title }}</td>
                            <td>{{ $item['blog']['category_name'] }}</td>
                            <td><img src="{{ asset($item->post_image) }}" alt="" style="width: 70px; height:40px;"></td>
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
                                               id="Delete"
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