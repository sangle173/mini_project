@extends('manager.manager_dashboard')
@section('users')

@section('title')
    Blog
@endsection
<!--breadcrumb-->
<div class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Post Details</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{$blog ->post_title}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <section class="blog-area pt-100px pb-100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="text-center text-primary">{{$blog ->post_title}}</h2>
                            <h5 class="fs-18 font-weight-semi-bold pt-3">Content</h5>

                            <p class="card-text pb-3"> {!! $blog->long_descp !!} </p>
                            <div class="section-block"></div>
                            <h5 class="fs-18 font-weight-semi-bold pt-3">Attachments</h5>
                            <div class="d-flex flex-wrap justify-content-between align-items-center pt-3">
                                <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                                    @foreach ($tags_all as $tag)
                                        <li class="mr-2"><a href="#">{{ ucwords($tag) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="section-block"></div>
                            <h5 class="fs-18 font-weight-semi-bold pt-3">Tags</h5>
                            <div class="d-flex flex-wrap justify-content-between align-items-center pt-3">
                                <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                                    @foreach ($tags_all as $tag)
                                        <li class="mr-2"><a href="#">{{ ucwords($tag) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                    <div class="section-block"></div>
                    <div class="add-comment-wrap pt-5">
                        <h3 class="fs-22 font-weight-semi-bold pb-4">Comment</h3>
                        <form class="row">
                            <div class="input-box col-lg-6">
                                <label class="label-text">Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name"
                                           placeholder="Enter Name">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Email</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="email" name="email"
                                           placeholder="Your email">
                                    <span class="la la-envelope input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-12">
                                <label class="label-text">Content</label>
                                <div class="form-group">
                                <textarea class="form-control form--control pl-3" name="message"
                                          placeholder="Enter content ..." rows="5"></textarea>
                                </div>
                            </div><!-- end input-box -->
                            <div class="btn-box col-lg-12 mt-2">
                                <button class="btn btn-success" type="submit">Send</button>
                            </div><!-- end btn-box -->
                        </form>
                    </div><!-- end add-comment-wrap -->
                </div><!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Category</h3>
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
                                <h3 class="card-title fs-18 pb-2">Recent</h3>
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
                    </div><!-- end col-lg-4 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div>
    </section><!-- end blog-area -->
    <!-- ================================
           START BLOG AREA
    ================================= -->
</div>

@endsection
