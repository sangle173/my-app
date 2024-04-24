@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @php
        $date = \Carbon\Carbon::today() ->format('l, F d, Y');

    @endphp
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Report: <b> {{$sj}}{{$date}}</b></li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <a href="mailto:?subject={{$sj}}{{$date}}&cc={{$cc}}" class="btn btn-primary float-end"><i
                            class="bi bi-cloud-arrow-up"></i> Open Outlook</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <div id="divExp" class="divExp">
                    <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><a
                                    name="_Hlk155304048">Hi Roger,</a></span></font></div>
                    <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;">Below is our status report for today. Please review and let us know if you have any comments or questions.</span></font>
                    </div>
                    <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><font
                                    size="4"><span
                                        style="font-size:14pt;"><b>&nbsp;</b></span></font></span></font></div>
                    <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><font
                                    size="4"><span
                                        style="font-size:14pt;"><b>Summary:</b></span></font></span></font></div>
                    <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                style="font-size:11pt;"><b>&nbsp;</b></span></font></div>

                    <!--        Table Summary-->
                    <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                        <tbody>
                        @foreach($teams as $key=> $item)
                            <tr height="25" style="height:15pt;border: none;background-color: {{$item -> color}}">
                                <td width="236" valign="bottom" nowrap=""
                                    style="width:141.75pt;height:15pt;padding:0 5.4pt;">
                <span>
                <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><font
                                color="black"><b>{{ $item -> team_name }}</b></font></span></font></div>
                </span>
                                </td>
                                <td width="167" valign="bottom" nowrap=""
                                    style="width:100.25pt;height:15pt;padding:0 5.4pt;">
                <span>
                <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><font
                                color="black">Testing request</font></span></font></div>
                </span></td>
                                <td width="133" valign="bottom" nowrap=""
                                    style="width:80pt;height:15pt;padding:0 5.4pt;">
                <span>
                <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><font
                                color="black">Done</font></span></font></div>
              </span></td>
                                <td width="80" nowrap="" style="width:48pt;height:15pt;padding:0 5.4pt;">
                <span>
                <div align="center" style="text-align:center;margin:0;"><font face="Calibri,sans-serif" size="2"><span
                            style="font-size:11pt;"><font
                                color="black">{{count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 1) ->get())}}</font></span></font></div>
                </span></td>
                            </tr>
                            <tr height="25" style="height:15pt;background-color: {{$item -> color}}">
                                <td width="236" valign="bottom" nowrap=""
                                    style="width:141.75pt;height:15pt;padding:0 5.4pt;">
                                            <span>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            color="black"></font></span></font></div>
                                            </span>
                                </td>
                                <td width="167" valign="bottom" nowrap=""
                                    style="width:100.25pt;height:15pt;padding:0 5.4pt;">
                                            <span>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            color="black"></font></span></font></div>
                                            </span></td>
                                <td width="133" valign="bottom" nowrap=""
                                    style="width:80pt;height:15pt;padding:0 5.4pt;">
                                            <span>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            color="black">In-progress</font></span></font></div>
                                          </span></td>
                                <td width="80" nowrap="" style="width:48pt;height:15pt;padding:0 5.4pt;">
                                            <span>
                                            <div align="center" style="text-align:center;margin:0;"><font
                                                    face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            color="black">{{count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 2) ->get())}}</font></span></font></div>
                                            </span></td>
                            </tr>
                            <tr height="25" style="height:15pt;background-color: {{$item -> color}}">
                                <td width="236" valign="bottom" nowrap=""
                                    style="width:141.75pt;height:15pt;padding:0 5.4pt;">
                                            <span>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            color="black"><b></b></font></span></font></div>
                                            </span>
                                </td>
                                <td width="167" valign="bottom" nowrap=""
                                    style="width:100.25pt;height:15pt;padding:0 5.4pt;">
                                            <span>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            color="black">Bug Found</font></span></font></div>
                                            </span></td>
                                <td width="133" valign="bottom" nowrap=""
                                    style="width:80pt;height:15pt;padding:0 5.4pt;">
                                            <span>
                                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            color="black">Open</font></span></font></div>
                                          </span></td>
                                <td width="80" nowrap="" style="width:48pt;height:15pt;padding:0 5.4pt;">
                                            <span>
                                            <div align="center" style="text-align:center;margin:0;"><font
                                                    face="Calibri,sans-serif" size="2"><span
                                                        style="font-size:11pt;"><font
                                                            color="black">{{count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 3) ->get())}}</font></span></font></div>
                                            </span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--       End Table Summary-->

                    <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                style="font-size:11pt;"><b>&nbsp;</b></span></font></div>
                    <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><font
                                    size="4"><span style="font-size:14pt;"><b>&nbsp;</b></span></font></span></font>
                    </div>
                    <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><font
                                    size="4"><span
                                        style="font-size:14pt;"><b>Details of the assignment:</b></span></font></span></font>
                    </div>
                    <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><font
                                    color="black">&nbsp;</font></span></font></div>
                    @foreach($teams as $key=> $item)
                        <div>
                            @if(
                                count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 1) ->get()) !=0 ||
                               count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 2) ->get()) !=0 ||
                                count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('action_id', 2) ->get()) !=0
    )
                                <div
                                    style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                            style="font-size:11pt;"><font size="4"
                                                                          color="#0070C0"><span
                                                    style="font-size:14pt;"><b>{{$item -> team_name}}</b></span></font></span></font>
                                </div>
                            @endif
                            @if(
                               count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 1) ->get()) !=0 ||
                               count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 2) ->get()) !=0
                               )
                                <div>
                                    <div style="text-indent:14pt;margin:0;"><font face="Calibri,sans-serif"
                                                                                  size="2"><span
                                                style="font-size:11pt;"><font size="4" color="black"><span
                                                        style="font-size:14pt;"><b>Testing request</b></span></font></span></font>
                                    </div>
                                </div>
                            @endif
                            @if(
                            count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 1) ->get()) !==0
                            )
                                <div>
                                    <div style="text-indent:22pt;margin:0;"><font face="Calibri,sans-serif"
                                                                                  size="2"><span
                                                style="font-size:11pt;"><font
                                                    color="black"><b>Done</b></font></span></font>
                                    </div>
                                    @foreach(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 1) ->get() as $key=> $taskItem)
                                        <div
                                            style="text-indent:33pt;margin:0;"><font
                                                face="Calibri,sans-serif" size="2"><span
                                                    style="font-size:11pt;"><a
                                                        href="https://jira.sonos.com/browse/{{$taskItem -> jira_id}}"
                                                        target="_blank"
                                                        rel="noopener noreferrer">{{$taskItem -> jira_id}}</a><font
                                                        color="black">
                                 - {{$taskItem -> summary}}</font></span></font>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if(
                       count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 2) ->get()) !==0
                       )
                                <div>
                                    <div style="text-indent:22pt;margin:0;"><font face="Calibri,sans-serif"
                                                                                  size="2"><span
                                                style="font-size:11pt;"><font
                                                    color="black"><b>In-progress</b></font></span></font>
                                    </div>
                                    @foreach(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 2) ->get() as $key=> $taskItem)
                                        <div
                                            style="text-indent:33pt;margin:0;"><font
                                                face="Calibri,sans-serif" size="2"><span
                                                    style="font-size:11pt;"><a
                                                        href="https://jira.sonos.com/browse/{{$taskItem -> jira_id}}"
                                                        target="_blank"
                                                        rel="noopener noreferrer">{{$taskItem -> jira_id}}</a><font
                                                        color="black">
                                 - {{$taskItem -> summary}}</font></span></font>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if(count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('action_id', 2) ->get()) != 0)
                                <div>
                                    <div style="text-indent:14pt;margin:0;"><font face="Calibri,sans-serif"
                                                                                  size="2"><span
                                                style="font-size:11pt;"><font size="4" color="black"><span
                                                        style="font-size:14pt;"><b>Bug found</b></span></font></span></font>
                                    </div>


                                    <div style="text-indent:22pt;margin:0;"><font face="Calibri,sans-serif"
                                                                                  size="2"><span
                                                style="font-size:11pt;"><font
                                                    color="black"><b>Open</b></font></span></font>
                                    </div>
                                    @foreach(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('action_id', 2) ->get() as $key=> $taskItem)
                                        <div
                                            style="text-indent:33pt;margin:0;"><font
                                                face="Calibri,sans-serif" size="2"><span
                                                    style="font-size:11pt;"><a
                                                        href="https://jira.sonos.com/browse/{{$taskItem -> jira_id}}"
                                                        target="_blank"
                                                        rel="noopener noreferrer">{{$taskItem -> jira_id}}</a><font
                                                        color="black">
                                 - {{$taskItem -> summary}}</font></span></font>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if(
                           count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 1) ->get()) !=0 ||
                          count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('working_status_id', 2) ->get()) !=0 ||
                           count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())-> where('team_id',$item -> id) -> where('action_id', 2) ->get()) !=0
)
                                <br>
                            @endif
                            @endforeach
                            <br>
                            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span
                                        style="font-size:11pt;">Thank you and best regards,</span></font>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection
