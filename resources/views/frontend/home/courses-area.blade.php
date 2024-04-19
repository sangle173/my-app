@php
    $courses = App\Models\Course::where('status',1)->orderBy('id','ASC')->limit(6)->get();
    $categories = App\Models\Category::orderBy('category_name','ASC')->get();
@endphp

<section class="course-area pb-120px">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">Lựa chọn khóa học</h5>
            <h2 class="section__title">Khóa học</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->

        <ul class="nav nav-tabs generic-tab justify-content-center pb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="business-tab" data-toggle="tab" href="#business" role="tab"
                   aria-controls="business" aria-selected="true">Tất cả khóa học</a>
            </li>
            @foreach ($categories as $category)

                <li class="nav-item">
                    <a class="nav-link" id="business-tab" data-toggle="tab" href="#business{{ $category->id }}"
                       role="tab" aria-controls="business" aria-selected="false">{{ $category->category_name }}</a>
                </li>
            @endforeach

        </ul>
    </div><!-- end container -->


    <div class="card-content-wrapper bg-gray pt-50px pb-120px">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="business" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">

                        @foreach ($courses as $course)

                            <div class="col-lg-4 responsive-column-half">
                                <div class="card card-item card-preview"
                                     data-tooltip-content="#tooltip_content_1{{ $course->id }}">
                                    <div class="card-image">
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}"
                                           class="d-block">
                                            <img class="card-img-top lazy" src="{{ asset($course->course_image) }}"
                                                 data-src="images/img8.jpg" alt="Ảnh khóa học ...">
                                        </a>


                                        @php
                                            $amount = $course->selling_price - $course->discount_price;
                                            $discount = ($amount/$course->selling_price) * 100;
                                        @endphp

                                        <div class="course-badge-labels">

                                            @if ($course->bestseller == 1)
                                                <div class="course-badge">Nhiều nhất</div>
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

                                    @php
                                        $reviewcount = App\Models\Review::where('course_id',$course->id)->where('status',1)->latest()->get();
                                        $avarage = App\Models\Review::where('course_id',$course->id)->where('status',1)->avg('rating');

                                    @endphp


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
                                            <p class="card-text"><span class="text-black">Thời lượng: </span><span> {{$course->duration}}</span>
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
                            </div><!-- end col-lg-4 -->
                        @endforeach


                    </div><!-- end row -->
                </div><!-- end tab-pane -->


                @foreach ($categories as $category)
                    <div class="tab-pane fade" id="business{{ $category->id }}" role="tabpanel"
                         aria-labelledby="business-tab">
                        <div class="row">
                            @php
                                $catwiseCourse = App\Models\Course::where('category_id',$category->id)->where('status',1)->orderBy('id','DESC')->get();
                            @endphp

                            @forelse ($catwiseCourse as $course)
                                <div class="col-lg-4 responsive-column-half">
                                    <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_2">
                                        <div class="card-image">
                                            <img class="card-img-top lazy" src="{{ asset($course->course_image) }}"
                                                 data-src="images/img8.jpg" alt="Card image cap">
                                        </div><!-- end card-image -->
                                        <div class="card-body">
                                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
                                            <h5 class="card-title"><a
                                                    href="course-details.html">{{ $course->course_name }}</a></h5>
                                            <p class="card-text"><a href=" ">{{ $course['user']['name'] }}</a></p>
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
                                                    <p class="card-price text-black font-weight-bold">{{ $course->selling_price }}
                                                        <sup>₫</sup></p>
                                                @else
                                                    <p class="card-price text-black font-weight-bold">{{ $course->discount_price }}
                                                        <sup>₫</sup> <span class="before-price font-weight-medium">${{ $course->selling_price }}<sup>₫</sup></span>
                                                    </p>
                                                @endif

                                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                                     title="Thêm vào yêu thích"><i class="la la-heart-o"></i></div>
                                            </div>
                                        </div><!-- end card-body -->
                                        <div class="card-footer text-muted">
                                            2 days ago
                                        </div>
                                    </div><!-- end card -->
                                </div><!-- end col-lg-4 -->

                            @empty

                                <h5 class="text-danger"> Không có khóa học </h5>

                            @endforelse


                        </div><!-- end row -->
                    </div><!-- end tab-pane -->
                @endforeach


            </div><!-- end tab-content -->
            <div class="more-btn-box mt-4 text-center">
                <a href="{{ url('course/all') }}" class="btn theme-btn">Tất cả các khóa học <i
                        class="la la-arrow-right icon ml-1"></i></a>
            </div><!-- end more-btn-box -->
        </div><!-- end container -->
    </div><!-- end card-content-wrapper -->
</section><!-- end courses-area -->


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
