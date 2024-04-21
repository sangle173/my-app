<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Task;
use App\Models\Team;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\WorkingStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTaskController extends Controller
{
    //
    public function AdminAllTask()
    {
        $tasks = Task::all();
        return view('admin.backend.tasks.all_task', compact('tasks'));

    }// End Method

    public function MyTask()
    {
        $id = Auth::user()->id;
        $tasks = Task::where('instructor_id',$id)->orderBy('id','desc')->get();
        return view('admin.backend.tasks.my_task', compact('tasks'));
    }// End Method

    public function AdminAddTask()
    {

        $teams = Team::latest()->get();
        $actions = Action::latest()->get();
        $working_statuses = WorkingStatus::latest()->get();
        $ticket_statuses = TicketStatus::latest()->get();
        $instructors = User::where('role', 'instructor')->latest()->get();
        $currentInstructor = Auth::user();
        return view('admin.backend.tasks.add_task', compact('teams', 'actions', 'working_statuses', 'ticket_statuses', 'instructors', 'currentInstructor'));
    }// End Method

    public function AdminStoreTask(Request $request)
    {

        $request->validate([
            'team_id' => 'required',
            'action_id' => 'required',
            'jira_id' => 'required',
            'summary' => 'required',
            'working_status_id' => 'required',
            'ticket_status_id' => 'required',
        ]);

        $task_id = Task::insertGetId([
            'team_id' => $request->team_id,
            'action_id' => $request->action_id,
            'jira_id' => $request->jira_id,
            'summary' => $request->summary,
            'working_status_id' => $request->working_status_id,
            'ticket_status_id' => $request->ticket_status_id,
            'instructor_id' => $request->instructor_id,
            'tester_1_id' => $request->tester_1_id,
            'tester_2_id' => $request->tester_2_id,
            'task_name_slug' => strtolower(str_replace(' ', '-', $request->task_name)),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Task Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.task')->with($notification);

    }// End Method

    public function AdminEditTask($id)
    {
        $task = Task::find($id);
        $teams = Team::latest()->get();
        $actions = Action::latest()->get();
        $working_statuses = WorkingStatus::latest()->get();
        $ticket_statuses = TicketStatus::latest()->get();
        $instructors = User::where('role','instructor')->latest()->get();
        $currentInstructor = Auth::user();
        return view('admin.backend.tasks.edit_task', compact('task','teams', 'actions', 'working_statuses', 'ticket_statuses', 'instructors', 'currentInstructor'));

    }// End Method

    public function AdminUpdateTask(Request $request)
    {

        $task_id = $request->task_id;

        Task::find($task_id)->update([
            'team_id' => $request->team_id,
            'action_id' => $request->action_id,
            'jira_id' => $request->jira_id,
            'summary' => $request->summary,
            'working_status_id' => $request->working_status_id,
            'ticket_status_id' => $request->ticket_status_id,
            'instructor_id' => $request->instructor_id,
            'tester_1_id' => $request->tester_1_id,
            'tester_2_id' => $request->tester_2_id,
            'task_name_slug' => strtolower(str_replace(' ', '-', $request->task_name)),
        ]);

        $notification = array(
            'message' => 'Task Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.task')->with($notification);

    }// End Method

    public function AdminDeleteTask($id)
    {
        Task::find($id)->delete();
        $notification = array(
            'message' => 'Task Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method
}
