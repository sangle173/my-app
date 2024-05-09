@extends('frontend.master')
@section('home')

@section('title')
    Player Management
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-item">
                <div class="card-body">
                    <h3 class="fs-24 font-weight-semi-bold pb-2">Player Manager <b
                            class="text-success">{{$playerip}}</b></h3>
                    <div class="divider"><span></span></div>
                    <div class="row">
                        <div class="col-lg-6">
                            {{--                        <ul class="list-group">--}}
                            {{--                            <li class="list-group-item">--}}
                            {{--                                <a href="http://{{$playerip}}:1400/reset" class="btn btn-danger" target="_blank">Reset</a>--}}
                            {{--                            </li>--}}
                            {{--                            <li class="list-group-item">--}}
                            {{--                                <a href="http://{{$playerip}}:1400/reboot" class="btn btn-danger" target="_blank">Reboot</a>--}}
                            {{--                            </li>--}}
                            {{--                            <li class="list-group-item">--}}
                            {{--                                <a href="http://{{$playerip}}:1400/status/zp" class="btn btn-danger" target="_blank">Player Info</a>--}}
                            {{--                            </li>--}}
                            {{--                            <li class="list-group-item">--}}
                            {{--                                <a href="http://{{$playerip}}:1400/status" class="btn btn-danger" target="_blank">Status</a>--}}
                            {{--                            </li>--}}
                            {{--                            <li class="list-group-item">--}}
                            {{--                                <a href="http://{{$playerip}}:1400/status/trueplayinfo" class="btn btn-danger" target="_blank">Trueplay info</a>--}}
                            {{--                            </li>--}}
                            {{--                        </ul>--}}
                            <iframe src="http://{{$playerip}}:1400/reset" title="Reset" frameborder="0"></iframe>
                            <iframe src="http://{{$playerip}}:1400/reboot" title="Reset" frameborder="0"></iframe>
                            <hr>
                            <iframe src="http://{{$playerip}}:1400/setstring" title="Reset" width="100%" height="400px" frameborder="0"></iframe>

                        </div>

                        <div class="col-lg-6">
                            <iframe src="http://{{$playerip}}:1400/status/zp" title="Reset" frameborder="0" width="100%" height="1000px"></iframe>
                        </div>
                    </div>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col-lg-5 -->
    </div><!-- end row -->
</div><!-- end container -->
@endsection
