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
                        <li class="breadcrumb-item active" aria-current="page">Report By Date</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form id="myForm" action="{{ route('search.by.date') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-2">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" id="start_date"  >
                    </div>
                    <div class="form-group col-md-2">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" id="end_date"  >
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>

                        </div>
                    </div>
                </form>


            </div>

        </div>
    {{-- // end row  --}}
        <!--end breadcrumb-->
        <p> Seach From <b>{{ $dateS -> format('d-m-Y') }}</b> to <b>{{ $dateE -> format('d-m-Y')}}</b></p>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Team</th>
                            <th>Type</th>
                            <th>JiraId-Summary</th>
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

                        @foreach ($results as $key=> $item)
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




@endsection
