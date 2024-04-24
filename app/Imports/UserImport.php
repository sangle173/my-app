<?php

namespace App\Imports;

use App\Models\Action;
use App\Models\Course;
use App\Models\Order;
use App\Models\Task;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\WorkingStatus;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class UserImport implements WithStartRow, WithValidation, OnEachRow
{
//    /**
//    * @param array $row
//    *
//    * @return \Illuminate\Database\Eloquent\Model|null
//    */
//    public function model(array $row)
//    {
////        dd($row);
//        return new User([
//            'name'     => $row[0],
//            'username'    => $row[1],
//            'email'    => $row[2],
//            'password'    => '123456',
//            'phone'    => $row[3],
//            'address'    => $row[4],
//        ]);
//    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '1' => 'unique:users,email'
        ];
    }

    public function customValidationMessages()
    {
        return [
            '1.unique' => 'Demo',
        ];
    }

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();
//        dd($test);
        $task = Task::create([
            'created_at' => Carbon::parse($row[0])->format('Y-m-d'),
            'team_id' => $row[1],
            'action_id' => Action::where('action_name', $row[2])->first() != null ? Action::where('action_name', $row[2])->first()->id : null,
            'jira_id' => $row[3],
            'summary' => $row[4],
            'working_status_id' => $row[5] != null ? WorkingStatus::where('working_status_name', $row[5])->first()->id : null,
            'ticket_status_id' => TicketStatus::where('ticket_status_name', $row[6])->first() != null ? TicketStatus::where('ticket_status_name', $row[6])->first()->id : null,
            'instructor_id' => $row[7] != null ? User::where('name', $row[7])->first()->id : 0,
            'tester_1_id' => $row[8] != null ? User::where('name', $row[8])->first()->id : null,
            'tester_2_id' => $row[9] != null ? User::where('name', $row[9])->first()->id : null
        ]);


//        if ($row[6]){
//            $course = Course::where('course_name', $row[6])->pluck('id');
//            $user->pluck('id');
//            $order = new Order();
//            $order->payment_id = 1;
//            $order->user_id = $user -> id;
//            $order->course_id = $course -> first();
//            $order->instructor_id = Auth::user()->id;
//            $order->save();
//        }
//        if ($row[7]){
//            $course = Course::where('course_name', $row[7])->pluck('id');
//            $user->pluck('id');
//            $order = new Order();
//            $order->payment_id = 1;
//            $order->user_id = $user -> id;
//            $order->course_id = $course -> first();
//            $order->instructor_id = Auth::user()->id;
//            $order->save();
//        }
//
//        if ($row[8]){
//            $course = Course::where('course_name', $row[8])->pluck('id');
//            $user->pluck('id');
//            $order = new Order();
//            $order->payment_id = 1;
//            $order->user_id = $user -> id;
//            $order->course_id = $course -> first();
//            $order->instructor_id = Auth::user()->id;
//            $order->save();
//        }
    }
}
