@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Thêm học viên vào khóa học</div>

            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">

            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90"
                             height="90" alt="...">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">{{ $course->course_name }}</h5>
                            <p class="mb-0">{{ $course->course_title }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-body">
                <form id="myForm" action="{{ route('instructor.order.update') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <input type="hidden" name="course_id" value="{{$course -> id}}">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Cập nhật lúc</th>
                                        <th>Lựa chọn</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($users as $key=> $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td><img
                                                    src="{{ (!empty($item->photo)) ? url('upload/user_images/'.$item->photo) : url('upload/no_image.jpg')}}"
                                                    alt="" style="width: 70px; height:40px;"></td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                {{ $item->address }}
                                            </td>
                                            <td>
                                                @if($item -> updated_at)
                                                    {{ $item->updated_at -> format('d/m/Y H:i') }}
                                                @else
                                                    {{ $item-> created_at -> format('d/m/Y H:i')}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" style="border: 1px solid black" name="user[]" type="checkbox"
                                                           value="{{$item -> id}}" id="defaultCheck{{$item->id}}">
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Lưu học viên</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
