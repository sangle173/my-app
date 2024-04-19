@extends('frontend.master')
@section('home')
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">{{ $subcategory->subcategory_name }}</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Trang chủ</a></li>
                <li>{{ $subcategory->category->category_name }}</li>
                <li>{{ $subcategory->subcategory_name }}</li>
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
                <p class="fs-14">Tìm thấy <span class="text-black">{{ count($courses) }}</span> khóa học</p>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="select-container select--container">
                        <select class="select-container-select">
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
                                    <input class="form-control form--control pl-3" type="text" name="search" placeholder="Tìm khóa học">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Danh mục khóa học</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                               @foreach ($categories as $cat)
                                <li><a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}">{{ $cat->category_name }}</a></li>
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
        <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
            <div class="card-image">
                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                    <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="images/img8.jpg" alt="Card image cap">
                </a>

                @php
                $amount = $course->selling_price - $course->discount_price;
                $discount = ($amount/$course->selling_price) * 100;
            @endphp


                <div class="course-badge-labels">
                    @if ($course->bestseller == 1)
                    <div class="course-badge">Bestseller</div>
                    @else
                    @endif
                </div>
            </div><!-- end card-image -->
            <div class="card-body">
                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
                <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                <p class="card-text"><a href="#">Giảng viên: <span class="text-danger">{{ $course['user']['name'] }}</span></a></p>
                <div class="d-flex justify-content-between align-items-center">
                    @if ($course->discount_price == NULL)
                    <p class="card-price text-black font-weight-bold">{{ number_format($course->selling_price, 0, '.', ',') }}<sup>₫</sup> </p>
                    @else
                    <p class="card-price text-black font-weight-bold">{{ number_format($course->discount_price, 0, '.', ',') }}<sup>₫</sup> <span class="before-price font-weight-medium">
{{ number_format($course->selling_price, 0, '.', ',') }}<sup>₫</sup></span></p>
                    @endif
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col-lg-6 -->
      @endforeach


                </div><!-- end row -->
            </div><!-- end col-lg-8 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->









@endsection
