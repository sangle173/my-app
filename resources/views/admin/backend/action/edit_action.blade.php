@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Team</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Team</h5>

                <form id="myForm" action="{{ route('update.action') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $action->id }}">

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Action Name</label>
                        <input type="text" name="action_name" class="form-control" id="input1"
                               value="{{ $action->action_name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input2" class="form-label">Color</label>
                        <input type="color" name="color" class="form-control" id="input2" value="{{ $action->color }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="color" class="form-label">Icon</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="icon" id="inlineRadio1" value="book-bookmark" {{ $action -> icon == 'book-bookmark' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1"><i class='bx bxs-book-bookmark' ></i></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="icon" id="inlineRadio2" value="bug-alt" {{ $action -> icon == 'bug-alt' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2"><i class='bx bxs-bug-alt'></i></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>



    <script type="text/javascript">

        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>


@endsection
