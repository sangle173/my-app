@extends('frontend.master')
@section('home')

@section('title')
    Upload Files
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<section class="register-area section-padding dot-bg overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="fs-24 font-weight-semi-bold pb-2">Upload Files to <b
                                class="text-success">{{$instructor->name}}</b></h3>
                        <div class="divider"><span></span></div>
                        <form id="myForm" action="{{ route('user.uploadfile.post') }}" method="post" class="row g-3"
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
                            <input type="hidden" class="form-input" name="instructor_id" value="{{ $instructor->id }}">
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
                                <label for="share" class="form-label"><b>Share File? </b> </label>
                                <input type="checkbox" id="share" name="share" value="1">
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <input type="submit" class="btn btn-primary px-4" value="Upload Files" disabled>
                                </div>
                            </div>
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-5 -->
            <div class="col-lg-12">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="fs-24 font-weight-semi-bold pb-2">Your Recent Files</h3>
                        <div class="divider"><span></span></div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File</th>
                                    <th>Download</th>
                                    <th>Uploaded by</th>
                                    <th>Uploaded at</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($files as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <a href="{{  asset('uploads/'.$item-> name) }}" target="blank" title="Review Files">{{substr($item-> name,11)}}</a>
                                        </td>
                                        <td>
                                            <a title="download" download href="{{  asset('uploads/'.$item-> name) }}"
                                               class="btn-lg btn-link text-primary text-decoration-none"
                                               target="_blank" title="Download File">
                                                <i class="la la-download icon ml-1" style="font-size: 1.5rem"></i>
                                            </a>
                                        </td>
                                        <td>
                                            {{\App\Models\User::find($item -> instructor_id) -> name}}
                                        </td>
                                        <td>{{$item -> created_at -> format('d/m/Y H:i')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-5 -->

        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end register-area -->
<script>
    $(document).ready(
        function () {
            $('input:file').change(
                function () {
                    if ($(this).val()) {
                        $('input:submit').attr('disabled', false);
                    }
                }
            );
        });
</script>
@endsection
