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
                    <li class="breadcrumb-item active" aria-current="page">Tất cả danh mục con</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
           <a href="{{ route('instructor.add.subcategory') }}" class="btn btn-primary px-5">Thêm mục con</a>
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
                            <th>Tên danh mục </th>
                            <th>Tên danh mục con</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($subcategory as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> {{ $item['category']['category_name'] }} </td>
                            <td> {{ $item->subcategory_name }} </td>
                            <td>
       <a href="{{ route('instructor.edit.subcategory',$item->id) }}" class="btn btn-info" title="Chỉnh sửa"><i class="lni lni-eraser"></i> </a>
{{--       <a href="{{ route('instructor.delete.subcategory',$item->id) }}" class="btn btn-danger px-5" title="Xóa" id="delete"><i class="lni lni-trash"></i> </a>--}}
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
