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
                    <li class="breadcrumb-item active" aria-current="page">Thêm mới học viên</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Thêm mới học viên</h5>
            <form id="myForm" action="{{ route('instructor.store.user') }}" method="post" class="row g-3" enctype="multipart/form-data">
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
                    <label for="input1" class="form-label">Tên đăng nhập</label>
                    <input type="text" name="username" class="form-control" id="input1"  >
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Tên</label>
                    <input type="text" name="name" class="form-control" id="input1"  >
                </div>
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="input1"  >
                </div>
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" id="input1"  >
                </div>
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" id="input1"  >
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="input1"  >
                </div>
                <div class="form-group col-md-12">
                    <label for="input1" class="form-label">Chọn khóa học</label>
                    @foreach ($courses as $course)
                    <div class="form-check">
                        <input class="form-check-input" name="course[]" type="checkbox" value="{{$course -> id}}" id="defaultCheck{{$course->id}}">
                        <label class="form-check-label" for="defaultCheck{{$course->id}}">
                            {{ $course->course_name }}
                        </label>
                    </div>
                    @endforeach
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label"> Quyền truy cập</label>
                    <input type="text" name="roles" class="form-control" id="input1" disabled value="Học Viên" >
                    </select>
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
          <button type="submit" class="btn btn-primary px-4">Tạo mới</button>

                    </div>
                </div>
            </form>
        </div>
    </div>




</div>


@endsection
