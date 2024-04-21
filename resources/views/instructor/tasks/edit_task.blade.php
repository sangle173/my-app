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
                        <li class="breadcrumb-item active" aria-current="page">Edit Task</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Task</h5>

                <form id="myForm" action="{{ route('update.task') }}" method="post" class="row g-3"
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
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <div class="form-group col-md-3">
                        <label for="team_id" class="form-label"><b>Team</b> </label>
                        <select name="team_id" id="team_id" class="form-select mb-3"
                                aria-label="Default select example">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $team->id == $task->team_id ? 'selected' : '' }} style="background-color: {{ $team -> color }};color: white">{{ $team->team_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="action_id" class="form-label"><b>Action</b> </label>
                        <select name="action_id" id="action_id" class="form-select mb-3"
                                aria-label="Default select example">
                            @foreach ($actions as $action)
                                <option value="{{ $action->id }}" {{ $action->id == $task->action_id ? 'selected' : '' }} style="background-color: {{ $action -> color }};color: white">{{ $action->action_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="working_status_id" class="form-label"><b>Working Status</b> </label>
                        <select name="working_status_id" id="working_status_id" class="form-select mb-3"
                                aria-label="Default select example">
                            @foreach ($working_statuses as $working)
                                <option value="{{ $working->id }}" {{ $working->id == $task->working_status_id ? 'selected' : '' }} style="background-color: {{ $working -> color }};color: white">{{ $working->working_status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ticket_status_id" class="form-label"><b>Ticket Status</b> </label>
                        <select name="ticket_status_id" id="ticket_status_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Select Action</option>
                            @foreach ($ticket_statuses as $ticket_status)
                                <option value="{{ $ticket_status->id }}" {{ $ticket_status->id == $task->ticket_status_id ? 'selected' : '' }} style="background-color: {{ $ticket_status -> color }};color: white">{{ $ticket_status->ticket_status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="jira_id" class="form-label"><b>Jira ID</b> <span class="text-danger">*</span></label>
                        <input type="text" name="jira_id" class="form-control" id="jira_id"  value="{{ $task-> jira_id }}">
                    </div>

                    <div class="form-group col-md-9">
                        <label for="summary" class="form-label"><b>Summary</b> <span class="text-danger">*</span></label>
                        <input type="text" name="summary" class="form-control" id="summary"  value="{{ $task-> summary }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="category_id" class="form-label"><b>Tester</b> </label>
                        <select name="instructor_id" id="category_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected value="{{ $currentInstructor->id}}">{{ $currentInstructor-> name .' (Bạn)'}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="category_id" class="form-label"><b>Tester 2</b> </label>
                        <select name="tester_1_id" id="category_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Select Tester 2</option>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ $instructor->id == $task->tester_1_id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="category_id" class="form-label"><b>Tester 3</b> </label>
                        <select name="tester_2_id" id="category_id" class="form-select mb-3"
                                aria-label="Default select example">
                            <option selected="" disabled>Select Tester 3</option>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ $instructor->id == $task->tester_2_id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Update Task</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
