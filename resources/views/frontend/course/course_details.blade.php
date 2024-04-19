@extends('frontend.master')
@section('home')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

@section('title')
    {{ $course->course_name }} | Luyện Thi Công chức
@endsection
<style>
    video::-internal-media-controls-download-button {
        display:none;
    }

    video::-webkit-media-controls-enclosure {
        overflow:hidden;
    }

    video::-webkit-media-controls-panel {
        width: calc(100% + 30px);
    }
</style>


<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area pt-50px pb-50px bg-white pattern-bg">
    <div class="container">
        <div class="col-lg-8 mr-auto">
            <div class="breadcrumb-content">
                <ul class="generic-list-item generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{url('/')}}">Trang chủ</a></li>
                    <li><a href="#">{{ $course['category']['category_name'] }}</a></li>
                    <li><a href="#">{{ $course['subcategory']['subcategory_name'] }}</a></li>
                </ul>
                <div class="section-heading">
                    <h2 class="section__title">{{ $course->course_name }}</h2>
                    <p class="section__desc pt-2 lh-30">{{ $course->course_title }}</p>
                </div><!-- end section-heading -->
                <div class="d-flex flex-wrap align-items-center pt-3">

                    @if ($course->bestseller == 1)
                        <h6 class="ribbon ribbon-lg mr-2 bg-3 text-white">Bestseller</h6>
                    @else
                    @endif

                    @php
                        $reviewcount = App\Models\Review::where('course_id',$course->id)->where('status',1)->latest()->get();
                        $avarage = App\Models\Review::where('course_id',$course->id)->where('status',1)->avg('rating');

                    @endphp
                </div><!-- end d-flex -->
                <p class="pt-2 pb-1">Giảng viên: <a href="{{url('/')}}"
                                                    class="text-color hover-underline">{{ $course['user']['name'] }}</a>
                </p>
                <div class="d-flex flex-wrap align-items-center">
                    <p class="pr-3 d-flex align-items-center">
                        <svg class="svg-icon-color-gray mr-1" width="16px" viewBox="0 0 24 24">
                            <path
                                d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                        </svg>
                        Cập nhật: {{ $course->created_at->format('d/m/Y') }}
                    </p>
                </div><!-- end d-flex -->
            </div><!-- end breadcrumb-content -->
        </div><!-- end col-lg-8 -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE DETAILS AREA
======================================-->
<section class="course-details-area pb-20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 pb-5">
                <div class="course-details-content-wrap pt-90px">
                    <div class="course-overview-card">
                        <h3 class="fs-24 font-weight-semi-bold pb-3">Bạn sẽ học được gì?</h3>
                        <ul class="generic-list-item overview-list-item">
                            @foreach ($goals as $goal)
                                <li><i class="la la-check mr-1 text-black"></i> {{ $goal->goal_name }} </li>
                            @endforeach

                        </ul>
                    </div><!-- end course-overview-card -->
                    <div class="course-overview-card">
                        <h3 class="fs-24 font-weight-semi-bold pb-3">Điều kiện để tham gia</h3>
                        <ul class="generic-list-item generic-list-item-bullet fs-15">
                            <li> {{ $course->prerequisites }} </li>

                        </ul>
                    </div><!-- end course-overview-card -->
                    <div class="course-overview-card">
                        <h3 class="fs-24 font-weight-semi-bold pb-3">Giới thiệu khóa học</h3>
                        <p class="fs-15 pb-2"> {!! $course->description !!} </p>


                        <div class="collapse" id="collapseMore">

                            <h4 class="fs-20 font-weight-semi-bold py-2">Khóa học này dành cho ai?:</h4>
                            <p class="fs-15 pb-2"> {{ $course->prerequisites }} </p>
                        </div>
                        <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse" href="#collapseMore"
                           role="button" aria-expanded="false" aria-controls="collapseMore">
                            <span class="collapse-btn-hide">Hiển thị thêm<i
                                    class="la la-angle-down ml-1 fs-14"></i></span>
                            <span class="collapse-btn-show">Ẩn bớt<i class="la la-angle-up ml-1 fs-14"></i></span>
                        </a>
                    </div><!-- end course-overview-card -->

                    @php
                        $lecture = App\Models\CourseLecture::where('course_id',$course->id)->get();
                    @endphp
                    <div class="course-overview-card">
                        <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
                            <h3 class="fs-24 font-weight-semi-bold">Nội dung khóa học</h3>
                            <div class="curriculum-duration fs-15">
                                <span class="curriculum-total__text mr-2"><strong
                                        class="text-black font-weight-semi-bold">Tổng cộng:</strong> {{count( DB::table("course_lectures") -> where("course_id", $course->id) ->get())}} bài học</span>
                                <span class="curriculum-total__hours"><strong class="text-black font-weight-semi-bold">Thời lượng:</strong> {{ $course->duration }}</span>
                            </div>
                        </div>

                        @php
                            $section = App\Models\CourseSection::where('course_id',$course->id)->orderBy('id','asc')->get();
                        @endphp

                        <div class="curriculum-content">
                            <div id="accordion" class="generic-accordion">

                                @foreach ($section as $sec)

                                    @php
                                        $lecture = App\Models\CourseLecture::where('section_id',$sec->id)->get();
                                    @endphp

                                    <div class="card">
                                        <div class="card-header" id="heading{{ $sec->id }}">
                                            <button
                                                class="btn btn-link d-flex align-items-center justify-content-between"
                                                data-toggle="collapse" data-target="#collapse{{ $sec->id }}"
                                                aria-expanded="true" aria-controls="collapse{{ $sec->id }}">
                                                <i class="la la-plus"></i>
                                                <i class="la la-minus"></i>
                                                {{ $sec->section_title }}
                                                <span class="fs-15 text-gray font-weight-medium">
                        {{ count($lecture) }} bài học</span>
                                            </button>
                                        </div><!-- end card-header -->
                                        <div id="collapse{{ $sec->id }}" class="collapse "
                                             aria-labelledby="heading{{ $sec->id }}" data-parent="#accordion">
                                            <div class="card-body">
                                                <ul class="generic-list-item">
                                                    @foreach ($lecture as $lect)
                                                        <li>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                @if($lect->status == "1")
                                                                    <span>
                                                                    <strong> <i class="la la-play-circle mr-1"></i>
                                                                    {{ $lect->lecture_title }} <br></strong>
                                                                        <div>
                                                                        <ul>
                                                                <li><strong>Nội dung:</strong> <br>{{$lect -> content}}</li>
                                                                            @if($lect->url)
                                                                <li>
                                                                    <strong>Tài liệu:</strong> <br>
                                                                     @foreach (explode(';', $lect->url) as $doc)
                                                                    <a href="{{  asset('upload/lecture/document/'.$doc) }}"
                                                                       class="text-decoration-none"
                                                                       target="_blank" title="Tài liệu"><i
                                                                            class="bx bxs-file"></i> {!! str_replace('upload/lecture/document/', '', $doc) !!}
                                                                    </a><br>
                                                                    @endforeach
                                                                </li>
                                                                            @endif
                                                                            @if($lect->video)
                                                                                <li>
                                                                                <strong>Bài giảng:</strong> <br>
                                                                                <video oncontextmenu="return false;" controlsList="nodownload" width="320" height="240"
                                                                                       controls>
                                    <source  src="{{ asset( $lect->video ) }}" type="video/mp4" >
                                </video>
                                                                            </li>
                                                                            @endif
                                                            </ul>
                                                                        </div>
                                                                    @else
                                                                            <span>
                                                                            <strong> <i class="la la-lock mr-1"></i>
                                                                    {{ $lect->lecture_title }}</strong> <br>
                                                                                <span> Nội dung: {{ $lect->content }}</span>
                                                                        </span>
                                                                        @endif
                                                                </span>
                                                                    <span>50:09 </span>
                                                            </div>
                                                        </li>
                                                        <hr>
                                                    @endforeach

                                                </ul>
                                            </div><!-- end card-body -->
                                        </div><!-- end collapse -->
                                    </div><!-- end card -->

                                @endforeach


                            </div><!-- end generic-accordion -->
                        </div><!-- end curriculum-content -->
                    </div><!-- end course-overview-card -->


                    <div class="course-overview-card pt-4">
                        <h3 class="fs-24 font-weight-semi-bold pb-4">Giới thiệu giảng viên</h3>
                        <div class="instructor-wrap">
                            <div class="media media-card">
                                <div class="instructor-img">
                                    <a href="{{url('/')}}" class="media-img d-block">
                                        <img class="lazy"
                                             src="{{ (!empty($course->user->photo)) ? url('upload/instructor_images/'.$course->user->photo) : url('upload/no_image.jpg')}}"
                                             data-src="images/small-avatar-1.jpg" alt="Avatar image">
                                    </a>
                                    <ul class="generic-list-item pt-3">
                                        {{--                                        <li><i class="la la-star mr-2 text-color-3"></i> 4.6 Instructor Rating</li>--}}
                                        {{--                                        <li><i class="la la-user mr-2 text-color-3"></i> 45,786 Students</li>--}}
                                        {{--                                        <li><i class="la la-comment-o mr-2 text-color-3"></i> 2,533 Reviews</li>--}}
                                        {{--                                        <li>--}}
                                        {{--                                            <i class="la la-play-circle-o mr-2 text-color-3"></i> {{ count($instructorCourses) }}--}}
                                        {{--                                            Courses--}}
                                        {{--                                        </li>--}}
                                        {{--                                        <li><a href=""{{url('/')}}">Tất cả khóa học</a></li>--}}
                                    </ul>
                                </div><!-- end instructor-img -->
                                <div class="media-body">
                                    <h5><a href=""{{url('/')}}">{{ $course['user']['name'] }}</a></h5>
                                    <p class="text-black lh-18 pb-3">{{ $course['user']['email'] }}</p>
                                    {{--                                    <p class="pb-3">Lorem Ipsum is simply dummy text of the printing and typesetting--}}
                                    {{--                                        industry. Lorem Ipsum has been the industry’s standard dummy text ever since the--}}
                                    {{--                                        1500s, when an unknown printer took a galley of type and scrambled it to make a--}}
                                    {{--                                        type specimen book. It has survived not only five centuries, but also the leap--}}
                                    {{--                                        into electronic typesetting, remaining essentially unchanged.</p>--}}
                                    {{--                                    <div class="collapse" id="collapseMoreTwo">--}}
                                    {{--                                        <p class="pb-3">After learning the hard way, Tim was determined to become the--}}
                                    {{--                                            best teacher he could, and to make his training as painless as possible, so--}}
                                    {{--                                            that you, or anyone else with the desire to become a software developer,--}}
                                    {{--                                            could become one.</p>--}}
                                    {{--                                        <p class="pb-3">If you want to become a financial analyst, a finance manager, an--}}
                                    {{--                                            FP&A analyst, an investment banker, a business executive, an entrepreneur, a--}}
                                    {{--                                            business intelligence analyst, a data analyst, or a data scientist, <strong--}}
                                    {{--                                                class="text-black font-weight-semi-bold">Tim Buchalka's courses are the--}}
                                    {{--                                                perfect course to start</strong>.</p>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse"--}}
                                    {{--                                       href="#collapseMoreTwo" role="button" aria-expanded="false"--}}
                                    {{--                                       aria-controls="collapseMoreTwo">--}}
                                    {{--                                        <span class="collapse-btn-hide">Hiển thị thêm<i--}}
                                    {{--                                                class="la la-angle-down ml-1 fs-14"></i></span>--}}
                                    {{--                                        <span class="collapse-btn-show">Ẩn bớt<i--}}
                                    {{--                                                class="la la-angle-up ml-1 fs-14"></i></span>--}}
                                    {{--                                    </a>--}}
                                </div>
                            </div>
                        </div><!-- end instructor-wrap -->
                    </div><!-- end course-overview-card -->
                </div><!-- end course-details-content-wrap -->
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar sidebar-negative">
                    <div class="card card-item">
                        <div class="card-body">
                            <div class="preview-course-video">
                                <video controls crossorigin playsinline poster="{{ asset($course->course_image) }}"
                                       id="player">
                                    <!-- Video files -->
                                    <source src="{{ asset($course->video) }}" type="video/mp4"/>
                                </video>
                                <p class="fs-15 font-weight-bold text-center text-black pt-3">Video giới thiệu</p>
                            </div><!-- end preview-course-video -->

                            @php
                                $amount = $course->selling_price - $course->discount_price;
                                $discount = ($amount/$course->selling_price) * 100;
                            @endphp

                            <div class="preview-course-feature-content pt-40px">

                                <p class="d-flex align-items-center pb-2">
                                    @if ($course->discount_price == NULL)
                                        <span
                                            class="fs-35 font-weight-semi-bold text-black">{{ number_format($course->selling_price, 0, '.', ',') }}<sup>₫</sup></span>
                                    @else
                                        <span
                                            class="fs-35 font-weight-semi-bold text-black">{{ number_format($course->discount_price , 0, '.', ',') }}<sup>₫</sup></span>
                                        <span class="before-price mx-1">{{ number_format($course->selling_price, 0, '.', ',') }}<sup>₫</sup></span>
                                    @endif
{{--                                    <span class="price-discount"> Giảm: {{ round($discount) }}%</span>--}}
                                </p>
                                <div class="buy-course-btn-box">
                                    <button type="submit" class="btn theme-btn w-100 mb-2"
                                            onclick="addToCart({{ $course->id }}, '{{ $course->course_name }}', '{{ $course->instructor_id }}', '{{ $course->course_name_slug }}' )">
                                        <i class="la la-shopping-cart fs-18 mr-1"></i> Thêm vào giỏ hàng
                                    </button>

                                    <button type="button" class="btn theme-btn w-100 theme-btn-white mb-2"
                                            onclick="buyCourse({{ $course->id }}, '{{ $course->course_name }}', '{{ $course->instructor_id }}', '{{ $course->course_name_slug }}' )">
                                        <i class="la la-shopping-bag mr-1"></i> Mua khóa học
                                    </button>
                                </div>
                            </div><!-- end preview-course-content -->
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Chi tiết khóa học</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-flash">
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-clock mr-2 text-color"></i>Thời lượng</span> {{ $course->duration }}
                                </li>

                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-file-text-o mr-2 text-color"></i>Resources</span> {{ $course->resources }}
                                </li>
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-bolt mr-2 text-color"></i>Bài kiểm tra</span> 1
                                </li>
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-eye mr-2 text-color"></i>Bài học</span> {{count( DB::table("course_lectures") -> where("course_id", $course->id) ->get())}}
                                </li>
                                {{--                                <li class="d-flex align-items-center justify-content-between"><span><i--}}
                                {{--                                            class="la la-language mr-2 text-color"></i>Ngôn ngữ</span> --}}
                                {{--                                </li>--}}
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-lightbulb mr-2 text-color"></i>Mức độ</span> {{ $course->label }}
                                </li>
                                {{--                                <li class="d-flex align-items-center justify-content-between"><span><i--}}
                                {{--                                            class="la la-users mr-2 text-color"></i>Số học viên:</span> {{count( DB::table("orders") -> where("course_id", $item->id) ->get())}}--}}
                                {{--                                </li>--}}
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-certificate mr-2 text-color"></i>Chứng chỉ</span> {{ $course->certificate == 'Yes'? 'Có': 'Không' }}
                                </li>
                            </ul>
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Danh mục khóa học</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                                @foreach ($categories as $cat)
                                    <li>
                                        <a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}">{{ $cat->category_name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Khóa học tương tự: </h3>
                            <div class="divider"><span></span></div>

                            @foreach ($relatedCourses as $related)
                                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                    <a href="course-details.html" class="media-img">
                                        <img class="mr-3 lazy" src="{{ asset($related->course_image) }}"
                                             data-src="{{ asset($related->course_image) }}" alt="Related course image">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="fs-15"><a href="{{url('/')}}"> {{ $related->course_name}}</a>
                                        </h5>
                                        <span class="d-block lh-18 py-1 fs-14">{{ $related['user']['name'] }}</span>

                                        @if ($course->discount_price == NULL)
                                            <p class="card-price text-black font-weight-bold">{{ number_format($course->selling_price, 0, '.', ',') }}<sup>₫</sup></p>
                                        @else
                                            <p class="card-price text-black font-weight-bold"> {{ number_format($course->discount_price, 0, '.', ',') }}<sup>₫</sup> <span class="before-price font-weight-medium">
{{ number_format($course->selling_price, 0, '.', ',') }}<sup>₫</sup></span></p>
                                        @endif

                                    </div>
                                </div><!-- end media -->


                            @endforeach


                            <div class="view-all-course-btn-box">
                                <a href="{{url('/')}}" class="btn theme-btn w-100">Tất cả khóa học <i
                                        class="la la-arrow-right icon ml-1"></i></a>
                            </div>
                        </div>
                    </div><!-- end card -->

                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end course-details-area -->
<!--======================================
        END COURSE DETAILS AREA
======================================-->

<!--======================================
        START RELATED COURSE AREA
======================================-->
<section class="related-course-area bg-gray pt-60px pb-60px">
    <div class="container">
        <div class="related-course-wrap">
            <h3 class="fs-28 font-weight-semi-bold pb-35px">Tất cả khóa học của:: <a href="{{url('/')}}"
                                                                                     class="text-color hover-underline">{{ $course['user']['name'] }}</a>
            </h3>
            <div class="view-more-carousel-2 owl-action-styled">

                @foreach ($instructorCourses  as $inscourse)

                    @php
                        $amount = $inscourse->selling_price - $inscourse->discount_price;
                        $discount = ($amount/$inscourse->selling_price) * 100;
                    @endphp


                    <div class="card card-item">
                        <div class="card-image">
                            <a href="{{ url('course/details/'.$inscourse->id.'/'.$inscourse->course_name_slug) }}"
                               class="d-block">
                                <img class="card-img-top" src="{{ asset($inscourse->course_image) }}"
                                     alt="Card image cap">
                            </a>
                            <div class="course-badge-labels">

                                @if ($inscourse->bestseller == 1)
                                    <div class="course-badge">Bestseller</div>
                                @else
                                @endif

                                @if ($inscourse->discount_price == NULL)
                                    <div class="course-badge blue">Mới</div>
                                @else
                                    <div class="course-badge blue">{{ round($discount) }}%</div>
                                @endif

                            </div>
                        </div><!-- end card-image -->
                        <div class="card-body">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $inscourse->label }}</h6>
                            <h5 class="card-title"><a
                                    href="{{ url('course/details/'.$inscourse->id.'/'.$inscourse->course_name_slug) }}">{{ $inscourse->course_name }}</a>
                            </h5>
                            <p class="card-text"><a href="{{url('/')}}">{{ $inscourse['user']['name'] }}</a></p>
                            <div class="rating-wrap d-flex align-items-center py-2">
                                <div class="review-stars">
                                    <span class="rating-number">4.4</span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                </div>
                                <span class="rating-total pl-1">(20,230)</span>
                            </div><!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">

                                @if ($course->discount_price == NULL)
                                    <p class="card-price text-black font-weight-bold">{{ number_format($course->selling_price, 0, '.', ',') }}
                                        <sup>₫</sup></p>
                                @else
                                    <p class="card-price text-black font-weight-bold">{{ number_format($course->discount_price, 0, '.', ',') }}<sup>₫</sup><span class="before-price font-weight-medium">
{{ number_format($course->selling_price, 0, '.', ',') }}<sup>₫</sup></span></p>
                                @endif


                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                     title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                @endforeach


            </div><!-- end view-more-carousel -->
        </div><!-- end related-course-wrap -->
    </div><!-- end container -->
</section><!-- end related-course-area -->
<!--======================================
        END RELATED COURSE AREA
======================================-->

{{--<div class="modal fade modal-container" id="previewModal" tabindex="-1" role="dialog"--}}
{{--     aria-labelledby="previewModalTitle" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header border-bottom-gray">--}}
{{--                <div class="pr-2">--}}
{{--                    <p class="pb-2 font-weight-semi-bold">Giới thiệu</p>--}}
{{--                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24"--}}
{{--                        id="previewModalTitle">{{ $course->course_name }}</h5>--}}
{{--                </div>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true" class="la la-times"></span>--}}
{{--                </button>--}}
{{--            </div><!-- end modal-header -->--}}
{{--            <div class="modal-body">--}}
{{--                <video controls crossorigin playsinline poster="{{ asset($course->course_image) }}" id="player">--}}
{{--                    <!-- Video files -->--}}
{{--                    <source src="{{ asset($course->video) }}" type="video/mp4"/>--}}
{{--                </video>--}}
{{--            </div><!-- end modal-body -->--}}
{{--        </div><!-- end modal-content -->--}}
{{--    </div><!-- end modal-dialog -->--}}
{{--</div><!-- end modal -->--}}

{{--<!-- Modal -->--}}
{{--<div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header border-bottom-gray">--}}
{{--                <div class="pr-2">--}}
{{--                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">Report Abuse</h5>--}}
{{--                    <p class="pt-1 fs-14 lh-24">Flagged content is reviewed by Aduca staff to determine whether it--}}
{{--                        violates Terms of Service or Community Guidelines. If you have a question or technical issue,--}}
{{--                        please contact our--}}
{{--                        <a href="contact.html" class="text-color hover-underline">Support team here</a>.</p>--}}
{{--                </div>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true" class="la la-times"></span>--}}
{{--                </button>--}}
{{--            </div><!-- end modal-header -->--}}
{{--            <div class="modal-body">--}}
{{--                <form method="post">--}}
{{--                    <div class="input-box">--}}
{{--                        <label class="label-text">Select Report Type</label>--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="select-container w-auto">--}}
{{--                                <select class="select-container-select">--}}
{{--                                    <option value>-- Select One --</option>--}}
{{--                                    <option value="1">Inappropriate Course Content</option>--}}
{{--                                    <option value="2">Inappropriate Behavior</option>--}}
{{--                                    <option value="3">Aduca Policy Violation</option>--}}
{{--                                    <option value="4">Spammy Content</option>--}}
{{--                                    <option value="5">Other</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="input-box">--}}
{{--                        <label class="label-text">Write Message</label>--}}
{{--                        <div class="form-group">--}}
{{--                            <textarea class="form-control form--control pl-3" name="message"--}}
{{--                                      placeholder="Provide additional details here..." rows="5"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="btn-box text-right pt-2">--}}
{{--                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>--}}
{{--                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Submit <i--}}
{{--                                class="la la-arrow-right icon ml-1"></i></button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div><!-- end modal-body -->--}}
{{--        </div><!-- end modal-content -->--}}
{{--    </div><!-- end modal-dialog -->--}}
{{--</div><!-- end modal -->--}}


@endsection
