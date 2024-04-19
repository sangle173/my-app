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
                        <li class="breadcrumb-item active" aria-current="page">Tất cả học viên</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ route('instructor.add.user') }}" class="btn btn-primary"><i class="bx bx-book-add"></i>Thêm học viên </a>
                        &nbsp;&nbsp;
                        <a href="{{ route('instructor.import.user') }}" class="btn btn-warning "> <i class="bx bx-cloud-upload"></i>Import </a>
                        &nbsp;&nbsp;
                        <a href="{{ route('instructor.export') }}" class="btn btn-danger "><i class="bx bx-cloud-download"></i>Export </a>
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
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Khóa học</th>
                            <th>Cập nhật lúc</th>
                            <th>Hành động</th>
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
                                <td class="text-left" width="20%">
                                    @php
                                        $latestOrders = \App\Models\Order::where('user_id',$item->id)->select('course_id', \DB::raw('MAX(id) as max_id'))->groupBy('course_id');
                                        $orders = \App\Models\Order::joinSub($latestOrders, 'latest_order', function($join) {
                                         $join->on('orders.id', '=', 'latest_order.max_id');
                                        })->orderBy('latest_order.max_id','DESC')->get();
                                    @endphp
                                    @if( \App\Models\Order::where('user_id',$item->id) -> get())
                                        @foreach ($orders as $key=> $order)
                                            @if($order-> course)
                                                <span>
                                                    <i class="lni lni-ticket-alt"></i> {{$order-> course -> course_name}}
                                                    <br>
                                                </span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span>Không có khóa học</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item -> updated_at)
                                        {{ $item->updated_at -> format('d/m/Y H:i') }}
                                    @else
                                        {{ $item-> created_at -> format('d/m/Y H:i')}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('instructor.edit.user',$item->id) }}" title="Chỉnh sửa"
                                       class="btn btn-info" title="Chỉnh sủa học viên">
                                        <i class="lni lni-eraser"></i> </a>
                                    <a href="{{ route('instructor.reset.user',$item->id) }}" class="btn btn-success"
                                       title="Reset mật khẩu">
                                        <i class='bx bx-reset'></i>
                                    </a>
                                    <a href="{{ route('instructor.delete.user',$item->id) }}" class="btn btn-danger"
                                       id="delete" title="Xóa học viên">
                                        <i class="lni lni-trash"></i>
                                    </a>
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
