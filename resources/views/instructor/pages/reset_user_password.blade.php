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
                        <li class="breadcrumb-item active" aria-current="page">Reset mật khẩu</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Reset mật khẩu học viên</h5>
                <form id="myForm" action="{{ route('instructor.reset.user.password',$user->id) }}" method="post"
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
                    <div class="form-group col-md-12">
                        <label for="name" class="form-label">Tên học viên</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$user -> name .' ('. $user -> email . ')'}}"
                               disabled>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="new_password" class="form-label">Mật khẩu mới</label>
                        <input type="text" name="new_password" id="new_password" class="form-control" id="input1"
                               placeholder="Nhập mật khẩu mới">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Reset mật khẩu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>


@endsection
