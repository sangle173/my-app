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
                    <li class="breadcrumb-item active" aria-current="page">Thêm mới danh mục con</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Thêm danh mục con</h5>
            <form id="myForm" action="{{ route('instructor.store.subcategory') }}" method="post" class="row g-3" enctype="multipart/form-data">
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
                    <label for="input1" class="form-label">Tên danh mục </label>
                    <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                        <option selected="" disabled>Chọn danh mục</option>
                        @foreach ($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach

                    </select>
                </div>


                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Tên danh mục con</label>
                    <input type="text" name="subcategory_name" class="form-control" id="input1"  >
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

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                subcategory_name: {
                    required : true,
                },
                category_id: {
                    required : true,
                },

            },
            messages :{
                subcategory_name: {
                    required : 'Vui lòng nhập danh mục con',
                },
                category_id: {
                    required : 'Vui lòng chọn danh mục',
                },


            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>




@endsection
