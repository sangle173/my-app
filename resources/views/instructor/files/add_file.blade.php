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
                        <li class="breadcrumb-item active" aria-current="page">Upload Files</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Upload Files</h5>

                <form id="myForm" action="{{ route('store.file') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
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
                    <input type="hidden" name="instructor_id" value="{{ $currentInstructor->id }}">
                    <div class="form-group col-md-12">
                        <label for="team_id" class="form-label"><b></b> </label>
                        <input
                            type="file"
                            name="files[]"
                            id="inputFile"
                            multiple
                            class="form-control @error('files') is-invalid @enderror">
                    </div>
                    <br>
                    <div class="form-group col-md-12">
                        <label for="share" class="form-label"><b>Share File?</b> </label>
                        <input type="checkbox" id="share" name="share" value="1">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Upload Files</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
