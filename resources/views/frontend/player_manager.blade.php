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
                    <form id="myForm" action="{{ route('player.manager') }}" method="get" class="row g-3">
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
                            <h5 class="fs-24 font-weight-semi-bold pb-2">Player IP: <b
                                    class="text-success">{{$playerip}}</b></h5>
                        </div><!-- end input-box -->
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <input type="text" name="player_ip" value="{{$playerip}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <button class="btn-sm btn-info" type="submit">Change <i
                                    class="la la-arrow-right icon ml-1"></i></button>
                        </div><!-- end input-box -->
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-lg-5">
                            <h6>Player Info</h6>
                            <hr>
                            <iframe src="http://{{$playerip}}:1400/status/zp" title="Reset" frameborder="0" width="100%"
                                    height="1000px"></iframe>
                        </div>
                        <div class="col-lg-5">
                            <h6>System Players</h6>
                            <hr>
                            {{--                            <iframe src="http://{{$playerip}}:1400/reset" title="Reset" frameborder="0"></iframe>--}}
{{--                            <iframe src="http://{{$playerip}}:1400/reboot" title="Reset" frameborder="0"></iframe>--}}
{{--                            <hr>--}}
{{--                            <iframe src="http://{{$playerip}}:1400/setstring" title="Reset" width="100%" height="400px"--}}
{{--                                    frameborder="0"></iframe>--}}
                            <iframe src="http://{{$playerip}}:1400/support/review" title="Reset" frameborder="0" width="100%"
                                    height="1000px"></iframe>
                        </div>


                        <div class="col-lg-2">
                            <h6>Actions</h6>
                            <hr>
                            <ul>
                                <li class="list-group-item">
                                    <a href="http://{{$playerip}}:1400/reset" target="_blank">Reset</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="http://{{$playerip}}:1400/reboot" target="_blank">Reboot</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="http://{{$playerip}}:1400/status" target="_blank">Status</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="http://{{$playerip}}:1400/setstring" target="_blank">Set String</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="http://{{$playerip}}:1400/testenv" target="_blank">OnlineUpdate</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="http://{{$playerip}}:1400/status/htconfig" target="_blank">Home Theater Configuration</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="http://{{$playerip}}:1400/status/trueplayinfo"
                                       target="_blank">Trueplay info</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="https://{{$playerip}}:1443/devunlock"
                                       target="_blank">Dev Unlock</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col-lg-5 -->
    </div><!-- end row -->
</div><!-- end container -->
@endsection
