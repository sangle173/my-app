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
                    <li class="breadcrumb-item active" aria-current="page">Thêm bài viết</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Thêm mới bài viết</h5>
            <form id="myForm" action="{{ route('instructor.store.blog.post') }}" method="post" class="row g-3" enctype="multipart/form-data">
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
                    <label for="input1" class="form-label">Danh mục bài viết </label>
                    <select name="blogcat_id" class="form-select mb-3" aria-label="Default select example">
                        <option value="">Chọn ...</option>
                        @foreach ($blogcat as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Tiêu đề bài viết </label>
                    <input type="text" name="post_title" class="form-control" id="input1"  >
                </div>



                <div class="form-group col-md-12">
                    <label for="input1" class="form-label">Nội dung </label>
                    <textarea name="long_descp" class="form-control" id="myeditorinstance"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Tags</label>
                    <input type="text" name="post_tags" class="form-control" data-role="tagsinput" value="Thuế">
                </div>

                <div class="col-md-6">
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Ảnh đại diện </label>
                    <input class="form-control" name="post_image" type="file" id="image">
                </div>

                <div class="col-md-6">
                    <img id="showImage" src="{{ url('upload/no_image.jpg')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">

                </div>



                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
          <button type="submit" class="btn btn-primary px-4">Thêm bài viết</button>

                    </div>
                </div>
            </form>
        </div>
    </div>




</div>



<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>


@endsection
