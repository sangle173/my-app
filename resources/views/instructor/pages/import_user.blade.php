@extends('instructor.instructor_dashboard')
@section('instructor')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <a href="{{ route('instructor.export') }}" class="btn btn-warning "><i class="lni lni-download"></i>Tải file Xlsx </a>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Import Học Viên</h5>
            <form id="myForm" action="{{ route('instructor.import') }}" method="post" class="row g-3" enctype="multipart/form-data">
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
                    <label for="input1" class="form-label">File Excel</label>
                    <input type="file" name="import_file" class="form-control" id="input1"  >
                    <p>(Lưu ý, email, tên đăng nhập của học viên không được trùng lặp)</p>
                </div>


                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
          <button type="submit" class="btn btn-primary px-4">Tải lên</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




</div>


@endsection
