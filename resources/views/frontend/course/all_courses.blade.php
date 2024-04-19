@extends('frontend.master')
@section('home')

@section('title')
    Tất cả khóa học | Luyện Thi Công Chức
@endsection
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li>Tất cả khóa học</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE AREA
======================================-->
<section class="course-area section--padding">
    <div class="container">
        <div class="filter-bar mb-4">
            <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                <p class="fs-14">Tìm thấy: <span class="text-black">{{ count($courses) }}</span> khóa học cho bạn</p>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="select-container select--container">
                        <select class="select-container-select">
                            <option value="">Tất cả khóa học</option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div><!-- end filter-bar-inner -->
        </div><!-- end filter-bar -->
        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar mb-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Tìm kiếm</h3>
                            <div class="divider"><span></span></div>
                            <form>
                                <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="text" name="search"
                                           placeholder="Tìm khóa học">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Danh mục</h3>
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
                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-8">
                <div class="row">


                    @foreach ($courses as $course)
                        <div class="col-lg-6 responsive-column-half">
                            <div class="card card-item card-preview"
                                 data-tooltip-content="#tooltip_content_1{{ $course->id }}">
                                <div class="card-image">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"
                                       class="d-block">
                                        <img class="card-img-top lazy" src="{{ asset($course->course_image) }}"
                                             data-src="images/img8.jpg" alt="Card image cap">
                                    </a>

                                    @php
                                        $amount = $course->selling_price - $course->discount_price;
                                        $discount = ($amount/$course->selling_price) * 100;
                                    @endphp

                                    <div class="course-badge-labels">
                                        @if ($course->bestseller == 1)
                                            <div class="course-badge">Mua nhiều nhất</div>
                                        @else
                                        @endif
                                        @if ($course->highestrated == 1)
                                            <div class="course-badge sky-blue">Đánh giá cao</div>
                                        @else
                                        @endif

                                        @if ($course->discount_price == NULL)
                                            <div class="course-badge blue">Mới</div>
                                        @else
                                            <div class="course-badge blue">{{ round($discount) }}%</div>
                                        @endif
                                    </div>
                                </div><!-- end card-image -->
                                <div class="card-body">
                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
                                    <h5 class="card-title"><a
                                            href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a>
                                    </h5>
                                    <p class="card-text"><span class="text-black">Giảng viên:</span><span
                                            class="text-danger"> {{ $course->user->name }}</span></p>
                                    <p class="card-text"><span
                                            class="text-black">Giới thiệu:</span> {{ \Illuminate\Support\Str::limit($course-> description, 150, $end='...') }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-text"><span
                                                class="text-black">Thời lượng: </span><span> {{$course->duration}}</span>
                                        </p>
                                        <p class="card-text"><span class="text-black">Số bài học: </span><span> {{count( DB::table("course_lectures") -> where("course_id", $course->id) ->get())}} bài</span>
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">

                                        @if ($course->discount_price == NULL)
                                            <p class="card-price text-black font-weight-bold">{{ number_format($course->selling_price, 0, '.', ',') }}
                                                <sup>₫</sup></p>
                                        @else
                                            <p class="card-price text-black font-weight-bold">{{ number_format($course->discount_price, 0, '.', ',') }}
                                                <sup>₫</sup> <span class="before-price font-weight-medium">{{ number_format($course->selling_price, 0, '.', ',') }}<sup>₫</sup></span>
                                            </p>
                                        @endif


                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                             title="Thêm vào yêu thích" id="{{ $course->id }}"
                                             onclick="addToWishList(this.id)"><i class="la la-heart-o"></i></div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col-lg-6 -->
                    @endforeach


                </div><!-- end row -->
                {{--                <div class="text-center pt-3">--}}
                {{--                    <nav aria-label="Page navigation example" class="pagination-box">--}}
                {{--                        <ul class="pagination justify-content-center">--}}
                {{--                            <li class="page-item">--}}
                {{--                                <a class="page-link" href="#" aria-label="Previous">--}}
                {{--                                    <span aria-hidden="true"><i class="la la-arrow-left"></i></span>--}}
                {{--                                    <span class="sr-only">Previous</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
                {{--                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                {{--                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                {{--                            <li class="page-item">--}}
                {{--                                <a class="page-link" href="#" aria-label="Next">--}}
                {{--                                    <span aria-hidden="true"><i class="la la-arrow-right"></i></span>--}}
                {{--                                    <span class="sr-only">Next</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </nav>--}}
                {{--                    <p class="fs-14 pt-2">Showing 1-10 of 56 results</p>--}}
                {{--                </div>--}}
            </div><!-- end col-lg-8 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->


@endsection

@php
    $courseData = App\Models\Course::get();
@endphp

<!-- tooltip_templates -->
@foreach ($courseData as $item)
    <div class="tooltip_templates">
        <div id="tooltip_content_1{{ $item->id }}">
            <div class="card card-item">
                <div class="card-body">
                    <p class="card-text pb-2">Tạo bởi <a href="{{ route('instructor.details',$item->instructor_id) }}">{{ $item['user']['name'] }}</a></p>
                    <h5 class="card-title pb-1"><a href="{{ url('course/details/'.$item->id.'/'.$item->course_name_slug) }}"> {{ $item->course_name }}</a></h5>
                    <div class="d-flex align-items-center pb-1">
                        @if ($item->bestseller == 1)
                            <h6 class="ribbon fs-14 mr-2">Mua nhiều nhất</h6>
                        @else
                            <h6 class="ribbon fs-14 mr-2">Mới</h6>
                        @endif

                        <p class="text-success fs-14 font-weight-medium">Cập nhật: <span
                                class="font-weight-bold pl-1">{{ $item->created_at->format('d/m/y') }}</span></p>
                    </div>
                    <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                        <li><span class="text-black">Thời lượng: </span> {{ $item->duration }}</li>
                        <li><span class="text-black">Đối tượng học: </span> {{ $item->label }}</li>
                    </ul>
                    <p class="card-text pt-1 fs-14 lh-22"><span class="text-black">Giới thiệu: </span> {{ $item->description }}</p>

                    @php
                        $goals = App\Models\Course_goal::where('course_id',$item->id)->orderBy('id','DESC')->get();
                    @endphp
                    <ul class="generic-list-item fs-14 py-3">
                        <span class="text-black">Bạn sẽ học được gì? </span>
                        @foreach ($goals as $goal)
                            <li><i class="la la-check mr-1 text-black"></i> {{ $goal->goal_name }}</li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">


                        <button type="submit" class="btn theme-btn flex-grow-1 mr-3"
                                onclick="addToCart({{ $item->id }}, '{{ $item->course_name }}','{{ $item->instructor_id }}','{{ $item->course_name_slug }}' )">
                            <i class="la la-shopping-cart mr-1 fs-18"></i>Đăng ký ngay
                        </button>

                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Thêm vào yêu thích"><i
                                class="la la-heart-o"></i></div>
                    </div>
                </div>
            </div><!-- end card -->
        </div>
    </div><!-- end tooltip_templates -->
@endforeach

