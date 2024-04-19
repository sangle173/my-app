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
                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa chương</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Chỉnh sửa chương</h5>

                <form id="myForm" action="{{ route('update.course.section') }}" method="post" class="row g-3" enctype="multipart/form-data">
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
                    <input type="hidden" name="id" value="{{ $section->id }}">

                    <div class="form-group col-md-6">
                        <label for="section_title" class="form-label">Tên chương</label>
                        <input type="text" name="section_title" class="form-control" id="section_title" value="{{ $section->section_title }}"  >
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Lưu chỉnh sửa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
