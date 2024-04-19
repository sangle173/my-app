@extends('frontend.master')
@section('home')
@section('title')
    {{ $blog->post_title  }} | Easy Learning
@endsection

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area pt-80px pb-80px pattern-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <div class="section-heading pb-3">
                <h2 class="section__title"> {{ $blog->post_title  }}</h2>
            </div>
            <ul class="generic-list-item generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="{{url('/')}}l">Trang chủ</a></li>
                <li><a href="{{ route('blog') }}">Bài viết</a></li>
                <li>{{ $blog->post_title  }}</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START BLOG AREA
================================= -->
<section class="blog-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="card card-item">
                    <div class="card-body">
                        <p class="card-text pb-3"> {!! $blog->long_descp !!} </p>
                        <div class="section-block"></div>
                        <h3 class="fs-18 font-weight-semi-bold pt-3">Tags</h3>
                        <div class="d-flex flex-wrap justify-content-between align-items-center pt-3">
                            <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                                @foreach ($tags_all as $tag)
                                    <li class="mr-2"><a href="#">{{ ucwords($tag) }}</a></li>

                                @endforeach
                            </ul>
                            <div class="share-wrap">
                                <ul class="social-icons social-icons-styled">
                                    <li class="mr-0"><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a>
                                    </li>
                                    <li class="mr-0"><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a>
                                    </li>
                                    <li class="mr-0"><a href="#" class="instagram-bg"><i
                                                class="la la-instagram"></i></a></li>
                                </ul>
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle"
                                     title="Toggle to expand social icons"><i class="la la-share-alt"></i></div>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
                <div class="section-block"></div>
                <div class="add-comment-wrap pt-5">
                    <h3 class="fs-22 font-weight-semi-bold pb-4">Bình luận</h3>
                    <form class="row">
                        <div class="input-box col-lg-6">
                            <label class="label-text">Họ và tên</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="text" name="name"
                                       placeholder="Họ và tên">
                                <span class="la la-user input-icon"></span>
                            </div>
                        </div><!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">Email</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="email" name="email"
                                       placeholder="Địa chỉ email">
                                <span class="la la-envelope input-icon"></span>
                            </div>
                        </div><!-- end input-box -->
                        <div class="input-box col-lg-12">
                            <label class="label-text">Nội dung</label>
                            <div class="form-group">
                                <textarea class="form-control form--control pl-3" name="message"
                                          placeholder="Viết bình luận ..." rows="5"></textarea>
                            </div>
                        </div><!-- end input-box -->
                        <div class="btn-box col-lg-12">
                            <button class="btn theme-btn" type="submit">Gửi bình luận</button>
                        </div><!-- end btn-box -->
                    </form>
                </div><!-- end add-comment-wrap -->
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Danh mục</h3>
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
                            <h3 class="card-title fs-18 pb-2">Bài viết gần đây</h3>
                            <div class="divider"><span></span></div>

                            @foreach ($post as $dpost)
                                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                    <a href="{{ url('blog/details/'.$dpost->post_slug) }}" class="media-img">
                                        <img class="mr-3" src="{{ asset($dpost->post_image) }}"
                                             alt="Related course image">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="fs-15"><a
                                                href="{{ url('blog/details/'.$dpost->post_slug) }}">{{ $dpost->post_title }}</a>
                                        </h5>
                                    </div>
                                </div><!-- end media -->

                            @endforeach

                            <div class="view-all-course-btn-box">
                                <a href="#" class="btn theme-btn w-100">Xem tất cả bài viết</a>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div>
</section><!-- end blog-area -->
<!-- ================================
       START BLOG AREA
================================= -->


@endsection
