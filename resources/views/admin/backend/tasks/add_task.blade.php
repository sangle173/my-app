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
                        <li class="breadcrumb-item active" aria-current="page">Add New Task</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">New Task</h5>

                <form id="myForm" action="{{ route('store.task') }}" method="post" class="row g-3"
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
                    <div class="form-group col-md-3">
                        <label for="team_id" class="form-label"><b>Team</b> </label>
                        <select name="team_id" id="team_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Select Team</option>
                            @foreach ($teams as $team)
                                <option style="background-color: {{ $team -> color }};color: white"
                                        value="{{ $team->id }}">{{ $team->team_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="action_id" class="form-label"><b>Action</b> </label>
                        <select name="action_id" id="action_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Select Action</option>
                            @foreach ($actions as $action)
                                <option style="background-color: {{ $action -> color }};color: white"
                                        value="{{ $action->id }}">{{ $action->action_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="working_status_id" class="form-label"><b>Working Status</b> </label>
                        <select name="working_status_id" id="working_status_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Select Working Status</option>
                            @foreach ($working_statuses as $working)
                                <option style="background-color: {{ $working -> color }};color: white"
                                        value="{{ $working->id }}">{{ $working->working_status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ticket_status_id" class="form-label"><b>Ticket Status</b> </label>
                        <select name="ticket_status_id" id="ticket_status_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Select Action</option>
                            @foreach ($ticket_statuses as $ticket_status)
                                <option style="background-color: {{ $ticket_status -> color }};color: white"
                                        value="{{ $ticket_status->id }}">{{ $ticket_status->ticket_status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="jira_id" class="form-label"><b>Jira ID</b> <span
                                class="text-danger">*</span></label>
                        <input type="text" name="jira_id" class="form-control" id="jira_id">
                    </div>

                    <div class="form-group col-md-9">
                        <label for="summary" class="form-label"><b>Summary</b> <span
                                class="text-danger">*</span></label>
                        <input type="text" name="summary" class="form-control" id="summary">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="instructor_id" class="form-label"><b>Tester</b> </label>
                        <select name="instructor_id" id="instructor_id" class="form-select mb-3"
                                aria-label="Default select example">
                            @foreach ($instructors as $instructor)
                                <option
                                    value="{{ $instructor->id }}" {{ $instructor->id == $currentInstructor->id ? 'selected' : '' }}>{{ $instructor->id == $currentInstructor->id ? $instructor->name .' (Bạn)': $instructor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tester_1_id" class="form-label"><b>Tester 2</b> </label>
                        <select name="tester_1_id" id="tester_1_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Select Tester 2</option>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tester_2_id" class="form-label"><b>Tester 3</b> </label>
                        <select name="tester_2_id" id="tester_2_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Select Tester 3</option>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Add New Task</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
