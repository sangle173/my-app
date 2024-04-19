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
                    <li class="breadcrumb-item active" aria-current="page">Danh mục bài viết</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

           <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm danh mục</button>
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
                            <th>Danh mục bài viết </th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($category as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> {{ $item->category_name }}  </td>
                            <td>

       <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#category" id="{{ $item->id }}" onclick="categoryEdit(this.id)"> <i class="lni lni-eraser"></i></button>

       <a href="{{ route('instructor.delete.blog.category',$item->id) }}" class="btn btn-danger" id="delete"><i class="lni lni-trash"></i> </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>




</div>


	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Danh mục bài viết</h5>

                </div>
                <div class="modal-body">
           <form action="{{ route('blog.category.store') }}" method="post">
            @csrf

            <div class="form-group col-md-12">
                <label for="input1" class="form-label">Tên danh mục bài viết</label>
                <input type="text" name="category_name" class="form-control" id="input1" required >
            </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục</h5>

                </div>
                <div class="modal-body">
           <form action="{{ route('blog.category.update') }}" method="post">
            @csrf

            <input type="hidden" name="cat_id" id="cat_id">

            <div class="form-group col-md-12">
                <label for="input1" class="form-label">Tên danh mục bài viết</label>
                <input type="text" name="category_name" class="form-control" id="cat"  required>
            </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        function categoryEdit(id){
            $.ajax({
                type: 'GET',
                url: '/edit/blog/category/'+id,
                dataType: 'json',

                success:function(data){
                    // console.log(data)
                    $('#cat').val(data.category_name);
                    $('#cat_id').val(data.id);

                }
            })

        }
    </script>

@endsection
