@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Chính sửa khóa học</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Chỉnh sửa khóa học</h5>

                <form id="myForm" action="{{ route('update.course') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <div class="form-group col-md-6">
                        <label for="course_name" class="form-label">Tên khóa học</label>
                        <input type="text" name="course_name" class="form-control" id="course_name"
                               value="{{ $course->course_name }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="course_title" class="form-label">Tiêu đề </label>
                        <input type="text" name="course_title" class="form-control" id="course_title"
                               value="{{ $course->course_title }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="category_id" class="form-label">Giảng viên </label>
                        <select name="instructor_id" id="category_id" class="form-select mb-3"
                                aria-label="Default select example">
                            @foreach ($instructors as $instructor)
                                <option
                                    value="{{ $instructor->id }}" {{ $instructor->id == $course-> instructor_id ? 'selected' : '' }}>{{ $instructor->id == $currentInstructor->id ? $instructor->name .' (Bạn)': $instructor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Danh mục </label>
                        <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Chọn danh mục</option>
                            @foreach ($categories as $cat)
                                <option
                                    value="{{ $cat->id }}" {{ $cat->id == $course->category_id ? 'selected' : '' }} >{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Subcategory </label>
                        <select name="subcategory_id" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Danh mục con</option>
                            @foreach ($subcategories as $subcat)
                                <option
                                    value="{{ $subcat->id }}" {{ $subcat->id == $course->subcategory_id ? 'selected' : '' }}>{{ $subcat->subcategory_name }}</option>
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Chứng chỉ? </label>
                        <select name="certificate" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select menu</option>
                            <option value="Yes" {{ $course->certificate == 'Yes' ? 'selected' : '' }}>Có</option>
                            <option value="No" {{ $course->certificate == 'No' ? 'selected' : '' }}>Không</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Nhãn </label>
                        <select name="label" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Vui lòng chọn</option>
                            <option value="Mới bắt đầu" {{ $course->label == 'Mới bắt đầu' ? 'selected' : '' }}>Mới bắt
                                đầu
                            </option>
                            <option value="Trung cấp" {{ $course->label == 'Trung cấp' ? 'selected' : '' }}>Trung cấp
                            </option>
                            <option value="Nâng cao" {{ $course->label == 'Nâng cao' ? 'selected' : '' }}>Nâng cao
                            </option>
                        </select>
                    </div>


                    <div class="form-group col-md-3">
                        <label for="selling_price" class="form-label">Giá khóa học </label>
                        <input type="text" name="selling_price" class="form-control" id="selling_price"
                               value="{{ $course->selling_price }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="discount_price" class="form-label">Giá sau khi giảm: </label>
                        <input type="text" name="discount_price" class="form-control" id="discount_price"
                               value="{{ $course->discount_price }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="duration" class="form-label">Thời lượng </label>
                        <input type="text" name="duration" class="form-control" id="duration"
                               value="{{ $course->duration }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="resources" class="form-label">Tài nguyên </label>
                        <input type="text" name="resources" class="form-control" id="resources"
                               value="{{ $course->resources }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="prerequisites" class="form-label">Điều kiện tiên quyết </label>
                        <textarea name="prerequisites" class="form-control" id="prerequisites"
                                  placeholder="Điều kiệ ..." rows="3">{{ $course->prerequisites }}</textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description" class="form-label">Mô tả khóa học </label>
                        <textarea name="description" class="form-control"
                                  id="description">{{$course->description }}</textarea>
                    </div>

                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bestseller" value="1"
                                       id="flexCheckDefault" {{ $course->bestseller == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">Bán chạy</label>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" value="1"
                                       id="flexCheckDefault2" {{ $course->featured == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault2">Nổi bật</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="highestrated" value="1"
                                       id="flexCheckDefault1" {{ $course->highestrated == '1' ? 'checked' : '' }}>

                                <label class="form-check-label" for="flexCheckDefault1">Đánh giá cao nhất</label>
                            </div>
                        </div>

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


    {{-- //// Start Main Course Image Update /// --}}

    <div class="page-content">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('update.course.image') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <input type="hidden" name="old_img" value="{{ $course->course_image }}">


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="input2" class="form-label">Ảnh đại diện </label>
                            <input class="form-control" name="course_image" type="file" id="image"
                                   accept="image/png, img/jpg">
                        </div>

                        <div class="col-md-6">
                            <img id="showImage" src="{{ asset($course->course_image) }}" alt="Admin"
                                 class="rounded-circle p-1 bg-primary" width="100">
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

    {{-- //// Start Main Course Image Update /// --}}



    {{-- //// Start Main Course Vidoe Update /// --}}

    <div class="page-content">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('update.course.video') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="vid" value="{{ $course->id }}">
                    <input type="hidden" name="old_vid" value="{{ $course->video }}">


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="input2" class="form-label">Video giới thiệu </label>
                            <input type="file" name="video" class="form-control" accept="video/mp4, video/webm">
                        </div>

                        @if($course->video)
                            <div class="col-md-6">
                                <video width="300" height="130" controls>
                                    <source src="{{ asset( $course->video ) }}" type="video/mp4">
                                </video>
                            </div>
                        @else<br>
                        <p>Khóa học chưa có video giới thiệu</p>
                        @endif
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

    {{-- //// Start Main Course Vidoe Update /// --}}





    {{-- //// Start Main Course Vidoe Update /// --}}

    <div class="page-content">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('update.course.goal') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $course->id }}">

                    <!--   //////////// Goal Option /////////////// -->
                    @foreach ($goals as $item)
                        <div class="row add_item">
                            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                <div class="container mt-2">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="goals" class="form-label"> Mục tiêu </label>
                                                <input type="text" name="course_goals[]" id="goals" class="form-control"
                                                       value="{{ $item->goal_name }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6" style="padding-top: 30px;">
                                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i>
                                                Thêm mục tiêu..</a>

                                            <span class="btn btn-danger btn-sm removeeventmore"><i
                                                    class="fa fa-minus-circle">Xóa</i></span>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!---end row-->

                @endforeach

                <!--   //////////// End Goal Option /////////////// -->


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

    {{-- //// Start Main Course Vidoe Update /// --}}









    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">


                        <div class="form-group col-md-6">
                            <label for="goals">Mục tiêu</label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control"
                                   placeholder="Mục tiêu  ">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i
                                    class="fa fa-plus-circle">Thêm</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Xóa</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!----For Section-------->
    <script type="text/javascript">
        $(document).ready(function () {
            var counter = 0;
            $(document).on("click", ".addeventmore", function () {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function (event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->



    <script type="text/javascript">

        $(document).ready(function () {
            $('select[name="category_id"]').on('change', function () {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
                rules: {
                    course_name: {
                        required: true,
                    },
                    course_title: {
                        required: true,
                    },

                },
                messages: {
                    course_name: {
                        required: 'Please Enter Course Name',
                    },
                    course_title: {
                        required: 'Please Enter Course Titile',
                    },


                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>


@endsection
