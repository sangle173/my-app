@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row">
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90"
                                 height="90" alt="...">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mt-0">{{ $course->course_name }}</h5>
                                <p class="mb-0">{{$course->course_title}}</p>
                            </div>
                            <div class="modal-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm bài học</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <form id="myForm" action="{{ route('add.course.section') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="hidden" name="id" value="{{ $course->id }}">

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Tên bài học</label>
                        <input type="text" name="section_title" class="form-control" id="input1">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="section_content" class="form-label">Nội dung </label>
                        <textarea name="section_content" class="form-control" id="section_content" placeholder="Nội dung ..." rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-12">
{{--                        <label for="input1" class="form-label">Video </label>--}}
{{--                        <input type="file" name="section_video" id="videoUpload" class="form-control"--}}
{{--                               accept="video/mp4, video/webm">--}}

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input2" class="form-label">Video bài học </label>
                                <input type="file" id="videoUpload" name="section_video" class="form-control"  accept="video/mp4, video/webm" >
                            </div>

                            <div class="col-md-6">
                                <video width="240" height="150" controls>
                                    Trình duyệt không hỗ trợ video này!
                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Tài liệu </label>
                        <input type="file" name="section_document" class="form-control"
                               accept="application/pdf, application/msword, application/vnd.ms-powerpoint">
                    </div>
                    <div class="form-group col-md-6">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Thêm mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script>
        document.getElementById("videoUpload")
            .onchange = function (event) {
            let file = event.target.files[0];
            let blobURL = URL.createObjectURL(file);
            document.querySelector("video").src = blobURL;
        }
    </script>
@endsection
