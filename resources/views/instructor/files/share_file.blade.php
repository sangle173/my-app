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
                        <li class="breadcrumb-item active" aria-current="page">Share File</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>File</th>
                            <th>Download</th>
                            <th>Uploaded by</th>
                            <th>Uploaded at</th>
                            <th>Action</th>
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
                                        <i class="lni lni-download" style="font-size: 1.5rem"></i>
                                    </a>
                                </td>
                                <td>
                                    {{\App\Models\User::find($item -> instructor_id) -> name}}
                                </td>
                                <td>{{$item -> created_at -> format('d/m/Y H:i')}}</td>
                                <td>
                                    @if(Auth::user()->id == $item -> instructor_id)
                                        <a href="{{ route('delete.file',$item->id) }}" class="btn btn-danger"
                                           id="delete"
                                           title="Xóa"><i class="lni lni-trash"></i> </a>
                                    @endif
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
