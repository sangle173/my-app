@extends('admin.admin_dashboard')
@section('admin')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Working Status</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.workingstatus') }}" class="btn btn-primary px-5">Add Working Status </a>
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
                            <th>Working Status Name</th>
                            <th>Color</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($working_status as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->working_status_name }}</td>
                                <td>
                                    <input type="color" value="{{ $item->color }}" disabled>
                                </td>
                                <td>
                                    {{--     @if (Auth::user()->can('category.edit')) --}}
                                    <a href="{{ route('edit.workingstatus',$item->id) }}" class="btn btn-info px-5">Edit </a>
                                    {{--     @endif --}}
                                    {{--     @if (Auth::user()->can('category.delete'))  --}}
                                    <a href="{{ route('delete.workingstatus',$item->id) }}" class="btn btn-danger px-5"
                                       id="delete">Delete </a>
                                    {{--       @endif                   --}}
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
