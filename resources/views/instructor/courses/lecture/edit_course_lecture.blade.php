@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row">
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mt-0">Chỉnh sửa bài học</h5>
                                <p class="mb-0">{{ $lecture->lecture_title }}</p>
                            </div>
                            <div class="modal-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <form id="myForm" action="{{ route('update.course.lecture.content') }}" method="post"
                          class="row g-3" enctype="multipart/form-data">
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
                        <input type="hidden" name="id" value="{{ $lecture->id }}">

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Tên bài học <span class="text-danger">*</span></label>
                            <input type="text" name="lecture_title" class="form-control" id="input1"
                                   value="{{$lecture->lecture_title}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="section_content" class="form-label">Nội dung </label>
                            <textarea name="lecture_content" class="form-control" id="section_content"
                                      placeholder="Nội dung ..." rows="3">{{$lecture->content}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="label" class="form-label">Trạng thái</label>
                            <select name="lecture_status" class="form-select mb-3" id="label" aria-label="Default select example">
                                <option value="0" {{ $lecture->status == '0' ? 'selected' : '' }}>Riêng tư</option>
                                <option value="1" {{ $lecture->status == '1' ? 'selected' : '' }}>Công khai</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Lưu</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update.course.lecture.video') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lecture_id" value="{{ $lecture->id }}">
                        <input type="hidden" name="old_vid" value="{{ $lecture->video }}">


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input2" class="form-label">Video bài học </label>
                                <input type="file" id="videoUpload" name="video" class="form-control"
                                       accept="video/mp4, video/webm">
                            </div>

                            <div class="col-md-6">
                                <video width="300" height="130" controls>
                                    <source src="{{ asset( $lecture->video ) }}" type="video/mp4">
                                </video>
                                <p>{!! str_replace('upload/lecture/video/', '', $lecture -> video) !!}</p>
                            </div>
                        </div>

                        <br><br>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Lưu</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update.course.lecture.document') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lecture_id" value="{{ $lecture->id }}">
                        <input type="hidden" name="old_doc" value="{{ $lecture->url }}">


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="section_document" class="form-label">Tài liệu </label>
{{--                                <input type="file" name="lecture_document" id="section_document" class="form-control"--}}
{{--                                       accept="application/pdf, application/msword, application/vnd.ms-powerpoint"--}}
{{--                                       value="{{ $lecture->url }}">--}}
                                <input type="file" name="files[]" id="lecture_document" onchange="javascript:updateList()" multiple class="form-control @error('files') is-invalid @enderror"
                                       accept="application/pdf, application/msword, application/vnd.ms-powerpoint">
                                <br>
                                @error('files')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <p>Tài liệu đã chọn:</p>
                                <div id="fileList">
                                    <ul>
                                        @foreach (explode(';', $lecture->url) as $info)
                                            <li>
                                                <a href="{{  asset('upload/lecture/document/'.$info) }}"
                                                   class="btn-lg btn-link text-primary text-decoration-none"
                                                   target="_blank" title="Tài liệu">
                                                    {!! str_replace('upload/lecture/document/', '', $info) !!}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <br><br>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Lưu</button>
                            </div>
                        </div>

                    </form>
                </div>
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

        updateList = function() {
            var input = document.getElementById('lecture_document');
            var output = document.getElementById('fileList');
            var children = "";
            for (var i = 0; i < input.files.length; ++i) {
                children += '<li>' + input.files.item(i).name + '</li>';
            }
            output.innerHTML = '<ul>'+children+'</ul>';
        }
    </script>
@endsection
