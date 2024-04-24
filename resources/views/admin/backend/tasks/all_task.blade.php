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
                        <li class="breadcrumb-item active" aria-current="page">Admin Task List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.import.task') }}" class="btn btn-primary px-5"><i
                            class="bx bx-message-add"></i>Import Task</a>
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

                        @foreach ($tasks as $key=> $item)
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
                                    <a href="{{ route('admin.delete.task',$item->id) }}" class="btn btn-danger"
                                       id="delete"
                                       title="Xóa"><i class="lni lni-trash"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>



    <script>
        $(document).ready(function () {
            $('.status-toggle').on('change', function () {
                var courseId = $(this).data('course-id');
                var isChecked = $(this).is(':checked');

                // send an ajax request to update status

                $.ajax({
                    url: "{{ route('update.course.status') }}",
                    method: "POST",
                    data: {
                        course_id: courseId,
                        is_checked: isChecked ? 1 : 0,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        toastr.success(response.message);
                    },
                    error: function () {

                    }
                });

            });
        });
    </script>
@endsection
