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
                        <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('instructor.add.blog.post') }}" class="btn btn-primary px-3"><i class="bx bx-book-add"></i>Thêm bài viết </a>
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
                            <th>Sl</th>
                            <th>Tiêu đề</th>
                            <th>Danh mục</th>
                            <th>Ảnh đại diện</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($post as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->post_title }}</td>
                                <td>{{ $item['blog']['category_name'] }}</td>
                                <td><img src="{{ asset($item->post_image) }}" alt="" style="width: 70px; height:40px;">
                                </td>

                                <td>
                                    <a href="{{ route('instructor.edit.post',$item->id) }}" class="btn btn-info" title="Chỉnh sửa bài viết">
                                        <i class="lni lni-eraser"></i> </a>
                                    <a href="{{ route('instructor.delete.post',$item->id) }}"
                                       class="btn btn-danger" id="delete" title="Xóa bài viết"><i class="lni lni-trash" ></i> </a>
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
