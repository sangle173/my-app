@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="container-fluid">

        <div class="section-block mb-5"></div>
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">Tên khóa học: {{ $course->course->course_name }}</h3>
        </div>
        <div class="dashboard-cards mb-5">
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
                                <div class="card-body mb-2">
                                    @foreach ($lecture -> sortBy('lecture_title') as $lect)
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h6 class="card-title"><a
                                                        href="{{ route('course.lecture.details',$lect->id) }}"><i
                                                            class="lni lni-ticket-alt text-primary"></i> {{ $lect->lecture_title }}
                                                    </a>
                                                </h6>
                                                <p class="card-text">
                                                    {{ $lect->content }}
                                                </p>
                                            </div>
                                            <div class="col-md-2">
                                                @if(!empty($lect -> video))
                                                    <a title="Xem bài giảng"
                                                       href="{{ route('course.lecture.details',$lect->id) }}"
                                                       type="button" class="btn btn-success text-white"><i
                                                            class="bx bx-play-circle"></i> Bắt đầu</a>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if(!empty($lect -> url))


                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenuButton" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                            <i
                                                                class="bx bx-cloud-download"></i>Tài liệu
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            @foreach (explode(';', $lect->url) as $doc)
                                                                <a href="{{  asset('upload/lecture/document/'.$doc) }}"
                                                                   class="dropdown-item"
                                                                   target="_blank" title="Tài liệu">
                                                                    <i
                                                                        class="bx bxs-file"></i> {!! str_replace('upload/lecture/document/', '', $doc) !!}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div><!-- end card-body -->
                            </div><!-- end collapse -->
                        </div><!-- end card -->

                    @endforeach


                </div><!-- end generic-accordion -->
            </div><!-- end curriculum-content -->        </div><!-- end col-lg-12 -->
    </div><!-- end col-lg-12 -->
    </div><!-- end container-fluid -->
@endsection
