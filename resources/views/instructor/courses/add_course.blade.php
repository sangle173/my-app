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
                        <li class="breadcrumb-item active" aria-current="page">Thêm mới khóa học</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Thêm khóa học</h5>

                <form id="myForm" action="{{ route('store.course') }}" method="post" class="row g-3"
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
                    <div class="form-group col-md-6">
                        <label for="course_name" class="form-label">Tên khóa học <span class="text-danger">* Không chứa /</span></label>
                        <input type="text" name="course_name" class="form-control" id="course_name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="course_title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" name="course_title" class="form-control" id="course_title">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="category_id" class="form-label">Giảng viên </label>
                        <select name="instructor_id" id="category_id" class="form-select mb-3"
                                aria-label="Default select example">
                            @foreach ($instructors as $instructor)
                                <option
                                    value="{{ $instructor->id }}" {{ $instructor->id == $currentInstructor->id ? 'selected' : '' }}>{{ $instructor->id == $currentInstructor->id ? $instructor->name .' (Bạn)': $instructor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="course_image" class="form-label">Ảnh đại diện </label>
                        <input class="form-control" name="course_image" type="file" id="course_image"
                               accept="image/png, img/jpg">
                    </div>

                    <div class="col-md-6">
                        <img id="showImage" src="{{ url('upload/no_image.jpg')}}" alt="Admin"
                             class="rounded-circle p-1 bg-primary" width="100">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Video giới thiệu </label>
                        <input type="file" name="video" class="form-control" accept="video/mp4, video/webm">
                    </div>

                    <div class="form-group col-md-6">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="category_id" class="form-label">Danh mục </label>
                        <select name="category_id" id="category_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Chọn danh mục</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="subcategory_id" class="form-label">Danh mục con </label>
                        <select name="subcategory_id" class="form-select mb-3" id="subcategory_id"
                                aria-label="Default select example">
                            <option></option>
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="certificate" class="form-label">Chứng chỉ? </label>
                        <select name="certificate" class="form-select mb-3" id="certificate"
                                aria-label="Default select example">
                            <option selected="" disabled>Vui lòng chọn</option>
                            <option value="Yes">Có</option>
                            <option value="No">Không</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="label" class="form-label">Nhãn </label>
                        <select name="label" class="form-select mb-3" id="label" aria-label="Default select example">
                            <option selected="" disabled>Vui lòng chọn</option>
                            <option value="Mới bắt đầu">Mới bắt đầu</option>
                            <option value="Trung cấp">Trung cấp</option>
                            <option value="Nâng cao">Nâng cao</option>
                        </select>
                    </div>


                    <div class="form-group col-md-3">
                        <label for="selling_price" class="form-label">Giá khóa học <span
                                class="text-danger">*</span></label>
                        <input type="number" name="selling_price" class="form-control" id="selling_price">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="discount_price" class="form-label">Giá sau khi giảm: </label>
                        <input type="number" name="discount_price" class="form-control" id="discount_price">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="duration" class="form-label">Thời lượng </label>
                        <input type="text" name="duration" class="form-control" id="duration">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="resources" class="form-label">Tài nguyên </label>
                        <input type="text" name="resources" class="form-control" id="resources">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="prerequisites" class="form-label">Điều kiện tiên quyết </label>
                        <textarea name="prerequisites" class="form-control" id="prerequisites"
                                  placeholder="Điều kiện ..." rows="3"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description" class="form-label">Mô tả khóa học </label>
                        <textarea name="description" class="form-control" id="description" placeholder="Mô tả ..."
                                  rows="3"></textarea>
                    </div>


                    <p>Mục tiêu khóa học </p>

                    <!--   //////////// Goal Option /////////////// -->

                    <div class="row add_item">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="goals" class="form-label"> Mục tiêu </label>
                                <input type="text" name="course_goals[]" id="goals" class="form-control"
                                       placeholder="Mục tiêu ">
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 30px;">
                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Thêm..</a>
                        </div>
                    </div> <!---end row-->

                    <!--   //////////// End Goal Option /////////////// -->


                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bestseller" value="1"
                                       id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Bán chạy</label>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" value="1"
                                       id="flexCheckDefault1">
                                <label class="form-check-label" for="flexCheckDefault1">Nổi bật</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="highestrated" value="1"
                                       id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">Đánh giá cao nhất</label>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Tạo mới khóa học</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>


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
                            <span class="btn btn-danger btn-sm removeeventmore"><i
                                    class="fa fa-minus-circle">Xóa</i></span>
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
                        required: 'Vui lòng nhập tên khóa học',
                    },
                    course_title: {
                        required: 'Vui lòng nhập tiêu đề'


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
