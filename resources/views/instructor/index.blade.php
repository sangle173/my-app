@extends('instructor.instructor_dashboard')
@section('instructor')

    @php
        use App\Models\Action;use Illuminate\Support\Carbon;
        $id = Auth::user()->id;
        $instructorId = App\Models\User::find($id);
        $status = $instructorId->status;
        $name = $instructorId->name;
        $alluser = App\Models\User::where('role','user')->get();
        $taskToday = App\Models\Task::whereDate('created_at', Carbon::today())->get();
        $actions = Action::all();
    @endphp

    <div class="page-content">

        @if ($status === '1')
            <h4>Hi <span class="text-success">{{$name}}</span></h4>
        @else
            <h4>Instructor Account Is <span class="text-danger">InActive</span></h4>
            <p class="text-danger"><b> Plz wait admin will check and approve your account</b></p>
        @endif


        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Task</p>
                                <h4 class="my-1 text-info">{{count($taskToday)}}</h4>
                                {{--                                <p class="mb-0 font-13">+5.4%</p>--}}
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-cosmic text-white ms-auto"><i
                                    class='bx bxs-book-open'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($actions as $key=> $item)
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total {{$item -> action_name}}</p>
                                    <h4 class="my-1 text-warning">{{count(App\Models\Task::where('action_id', '=', $item -> id) -> whereDate('created_at', '=',  Carbon::today()) -> get())}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle text-white ms-auto"
                                     style="background-color: {{$item -> color}}"><i
                                        class="bx bxs-{{$item -> icon}}"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!--end row-->

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Team Task Tracking Today</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.task') }}" class="btn btn-primary px-5"><i class="bx bx-message-add"></i>Add
                        Task </a>
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
                            <th>Team</th>
                            <th>Type</th>
                            <th width="25%">JiraId-Summary</th>
                            <th>Working Status</th>
                            <th>Ticket Status</th>
                            <th>Tester 1</th>
                            <th>Tester 2</th>
                            <th>Tester 3</th>
                            <th>Create At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($taskToday as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <span class="badge"
                                          style="background-color: {{ \App\Models\Team::find($item -> team_id) != null? \App\Models\Team::find($item -> team_id) -> color: 'black' }}; color: black">{{ \App\Models\Team::find($item -> team_id) !=null ? \App\Models\Team::find($item -> team_id) -> team_name: '' }}</span>
                                </td>
                                <td>
                                    <i style="font-size: 1.2rem;color: {{\App\Models\Action::find($item -> action_id) !=null? \App\Models\Action::find($item -> action_id)-> color: 'black'}}"
                                       class="bx bxs-{{\App\Models\Action::find($item -> action_id) != null?\App\Models\Action::find($item -> action_id) -> icon: ''}}"></i>
                                </td>
                                <td width="25%">
                                    <a href="https://jira.sonos.com/browse/{{$item -> jira_id}}">{{$item -> jira_id}} </a>
                                    - {{$item -> summary}}
                                </td>
                                <td>
                                    <span class="badge"
                                          style="background-color: {{ \App\Models\WorkingStatus::find($item -> working_status_id)!=null? \App\Models\WorkingStatus::find($item -> working_status_id) -> color: 'black' }}">{{ \App\Models\WorkingStatus::find($item -> working_status_id)!= null? \App\Models\WorkingStatus::find($item -> working_status_id) -> working_status_name: '' }}</span>
                                </td>
                                <td>
                                    <span class="badge"
                                          style="background-color: {{ \App\Models\TicketStatus::find($item -> ticket_status_id) != null? \App\Models\TicketStatus::find($item -> ticket_status_id)-> color: 'black'}}">
                                        {{ \App\Models\TicketStatus::find($item -> ticket_status_id) != null ? \App\Models\TicketStatus::find($item -> ticket_status_id) -> ticket_status_name: '' }}</span>
                                </td>
                                <td>{{ \App\Models\User::find($item -> instructor_id) !=null ? \App\Models\User::find($item -> instructor_id) -> name: '' }}</td>
                                <td>
                                    @if($item -> tester_1_id)
                                        {{ \App\Models\User::find($item -> tester_1_id) !=null? \App\Models\User::find($item -> tester_1_id) -> name: ''}}
                                    @endif
                                </td>
                                <td>
                                    @if($item -> tester_2_id)
                                        {{ \App\Models\User::find($item -> tester_2_id) !=null?\App\Models\User::find($item -> tester_2_id) -> name: '' }}
                                    @endif
                                </td>
                                <td>{{$item -> created_at -> format('d/m/Y H:i')}}</td>
                                <td>
                                    @if(Auth::user()->id == $item -> instructor_id)
                                        <a href="{{ route('edit.task',$item->id) }}" class="btn btn-info"
                                           title="Chỉnh sửa"><i
                                                class="lni lni-eraser"></i> </a>
                                        <a href="{{ route('delete.task',$item->id) }}" class="btn btn-danger"
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
@endsection
