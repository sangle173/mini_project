@extends('manager.manager_dashboard')
@section('users')

@section('title')
    Blog
@endsection
<!--breadcrumb-->
<div class="page-content">

    <div class=" d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('blog.post') }}">All Blogs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$blog ->post_title}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <section class="blog-area pt-100px pb-100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-item">
                        <div class="card-body">
                            <p class="card-text"> {!! $blog->long_descp !!} </p>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                    <div class="section-block"></div>
                </div><!-- end col-lg-8 -->
                <div class="col-md-2">
                    <div class="sidebar">
                        <div class="card card-item">
                            <div class="card-body">
                                <h5 class="card-title fs-18 pb-2">Category</h5>
                                <div class="divider"><span></span></div>
                                <ul class="generic-list-item">
                                    @foreach ($bcategory as $cat)
                                        <li><a href="{{ url('blog/cat/list/'.$cat->id) }}">{{ $cat->category_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- end card -->

                        <div class="card card-item">
                            <div class="card-body">
                                <h5 class="card-title fs-18 pb-2">Recents</h5>
                                <div class="divider"><span></span></div>
                                <ul class="generic-list-item">
                                    @foreach ($post as $dpost)
                                        <li><a
                                                href="{{ route('view.post', $dpost->id) }}">{{ $dpost->post_title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h5 class="card-title fs-18 pb-2">Tags</h5>
                                <div class="divider"><span></span></div>
                                <ul class="generic-list-item">
                                    @foreach ($tags_all as $tag)
                                        <li class="mr-2"><a href="#">{{ ucwords($tag) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col-lg-4 -->
                </div>
            </div><!-- end container -->
        </div>
    </section>
</div>

@endsection
