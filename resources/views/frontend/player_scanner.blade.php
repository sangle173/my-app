@extends('frontend.master')
@section('home')

@section('title')
    Player Scanner
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="container-fluid">
    <div class="row">
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
                                <th>IP</th>
                                <th>MacAddress</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($array as $key=> $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        {{$item -> ip}}
                                    </td>
                                    <td>
                                        {{$item -> mac_address}}
                                    </td>
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
@endsection
