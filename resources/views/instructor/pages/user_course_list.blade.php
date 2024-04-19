@extends('instructor.instructor_dashboard')
@section('instructor')


    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Khóa học đã mua</li>
                        <li class="breadcrumb-item active" aria-current="page">Học viên: {{$user -> name}} ({{$user -> email}})</li>

                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ route('instructor.add.user') }}" class="btn btn-primary">Thêm khóa học </a>
                    </div>
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
                            <th>Giá bán</th>
                            <th>Thời lượng</th>
                            <th>Tạo bởi</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($courses as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img class="card-img-top"
                                         src="{{ (!empty(asset($item->course->course_image))) ? asset($item->course->course_image) : url('upload/no_image.jpg')}}"
                                         style="width: 100px; height:70px;" alt="Ảnh khóa học">
                                </td>
                                <td><a href="{{ route('instructor.course.details',$item -> course->id) }}" class="text-decoration-none">{{ $item-> course -> course_name }}</a></td>
                                <td>{{number_format($item-> course -> selling_price, 0, '.', ',') }}<sup>₫</sup></td>
                                <td>{{ $item->course->duration }}</td>
                                <td>{{ $item -> course-> instructor_id == Auth::user() ->id ? $item-> course['user']['name'] .' (Bạn)': $item-> course['user']['name']}}</td>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
