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
                        <li class="breadcrumb-item active" aria-current="page">Danh sách khóa học</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.course') }}" class="btn btn-primary px-5"><i class="bx bx-message-add"></i>Thêm khóa học </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Tên khóa học</th>
                            <th>Danh mục</th>
                            <th>Giá bán</th>
                            <th>Thời lượng</th>
                            <th>Số học viên</th>
                            <th>Số bài học</th>
                            <th title="Bật để công khai khóa học/ tắt để ở chế độ ẩn">Mở</th>
                            <th>Tạo bởi</th>
                            <th>Cập nhật lúc</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($courses as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img src="{{ asset($item->course_image) }}" alt=""
                                         style="width: 70px; height:40px;"></td>
                                <td>{{ $item->course_name }}</td>
                                <td>{{ $item['category']['category_name'] }}</td>
                                @php
                                    $amount = $item->selling_price - $item->discount_price;
                                    $discount = ($amount/$item->selling_price) * 100;
                                @endphp
                                <td>
                                    @if ($item->discount_price == NULL)
                                        <p class="card-price text-black font-weight-bold">{{ number_format($item->selling_price, 0, '.', ',') }}
                                            <sup>₫</sup></p>
                                    @else
                                        <p class="card-price text-black font-weight-bold">{{ number_format($item->discount_price, 0, '.', ',') }}
                                            <sup>₫</sup> <span class="text-decoration-line-through before-price font-weight-medium">{{ number_format($item->selling_price, 0, '.', ',') }}<sup>₫</sup></span>
                                        </p>
                                    @endif
                                <td>{{ $item->duration }}</td>
                                <td>{{count( DB::table("orders") -> where("course_id", $item->id) ->get())}}</td>
                                <td>{{count( DB::table("course_lectures") -> where("course_id", $item->id) ->get())}}</td>
                                <td style="text-align: right!important;">
                                    <div class="form-check-danger form-check form-switch">
                                        <input class="form-check-input status-toggle large-checkbox" title="Tắt/Bật trạng thái của khóa học" type="checkbox" id="flexSwitchCheckCheckedDanger" data-course-id="{{ $item->id }}" {{ $item->status ? 'checked' : ''}}  >
                                    </div>
                                </td>
                                <td>{{ $item -> instructor_id == Auth::user() ->id ? $item['user']['name'] .' (Bạn)': $item['user']['name']}}
                                    </td>
                                <td>
                                    @if($item -> updated_at)
                                        {{ $item->updated_at -> format('d/m/Y H:i') }}
                                    @else
                                        {{ $item-> created_at -> format('d/m/Y H:i')}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('course.all.lecture',$item->id) }}" class="btn btn-warning"
                                       title="Tất cả bài học"><i class="lni lni-list"></i> </a>

                                    <a href="{{ route('edit.course',$item->id) }}" class="btn btn-info"
                                       title="Chỉnh sửa"><i
                                            class="lni lni-eraser"></i> </a>
                                    <a href="{{ route('instructor.course.details',$item->id) }}" class="btn btn-success"><i
                                            class="lni lni-eye"></i></a>

                                                                        <a href="{{ route('delete.course',$item->id) }}" class="btn btn-danger"
                                       id="delete"
                                       title="Xóa"><i class="lni lni-trash"></i> </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>



    <script>
        $(document).ready(function(){
            $('.status-toggle').on('change', function(){
                var courseId = $(this).data('course-id');
                var isChecked = $(this).is(':checked');

                // send an ajax request to update status

                $.ajax({
                    url: "{{ route('update.course.status') }}",
                    method: "POST",
                    data: {
                        course_id : courseId,
                        is_checked: isChecked ? 1 : 0,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response){
                        toastr.success(response.message);
                    },
                    error: function(){

                    }
                });

            });
        });
    </script>
@endsection
