<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
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
            '1.unique' => 'Email không được trùng lặp',
        ];
    }

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        $user = User::create([
            'name' => $row[0],
            'username' => $row[1],
            'email' => $row[2],
            'phone' => $row[3],
            'address' => $row[4],
            'password' => $row[5]
        ]);


        if ($row[6]){
            $course = Course::where('course_name', $row[6])->pluck('id');
            $user->pluck('id');
            $order = new Order();
            $order->payment_id = 1;
            $order->user_id = $user -> id;
            $order->course_id = $course -> first();
            $order->instructor_id = Auth::user()->id;
            $order->save();
        }
        if ($row[7]){
            $course = Course::where('course_name', $row[7])->pluck('id');
            $user->pluck('id');
            $order = new Order();
            $order->payment_id = 1;
            $order->user_id = $user -> id;
            $order->course_id = $course -> first();
            $order->instructor_id = Auth::user()->id;
            $order->save();
        }

        if ($row[8]){
            $course = Course::where('course_name', $row[8])->pluck('id');
            $user->pluck('id');
            $order = new Order();
            $order->payment_id = 1;
            $order->user_id = $user -> id;
            $order->course_id = $course -> first();
            $order->instructor_id = Auth::user()->id;
            $order->save();
        }
    }
}
