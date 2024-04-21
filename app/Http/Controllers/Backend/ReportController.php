<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use DateTime;

class ReportController extends Controller
{
    public function ReportView(){
        $dateS = Carbon::today();
        $dateE = Carbon::today();
        $results = Task::latest()->get();
        return view('admin.backend.report.report_by_date', compact('results', 'dateE','dateS'));


    } // End Method


    public function SearchByDate(Request $request){
        $dateS = new Carbon($request->start_date);
        $dateE = new Carbon($request->end_date);
        if(!empty($request->start_date)&&!empty($request->end_date)){
            $results = Task::where(function($query)use($request){
                if(!empty($request->start_date)&&!empty($request->end_date)){
                    $dateS = new Carbon($request->start_date);
                    $dateE = new Carbon($request->end_date);
                    $dateE -> addDays(1);
                    $query->whereBetween('created_at', [$dateS->format('Y-m-d'), $dateE->format('Y-m-d')]);
                }
            })->get();
        } else {
            $results = Task::latest()->get();
        }

        return view('admin.backend.report.report_by_date',compact('results', 'dateE','dateS'));

    }// End Method


    public function SearchByMonth(Request $request){

        $month = $request->month;
        $year = $request->year_name;

        $payment = Payment::where('order_month',$month)->where('order_year',$year)->latest()->get();
        return view('admin.backend.report.report_by_month',compact('payment','month','year'));

    }// End Method


    public function SearchByYear(Request $request){

        $year = $request->year;

        $payment = Payment::where('order_year',$year)->latest()->get();
        return view('admin.backend.report.report_by_year',compact('payment', 'year'));

    }// End Method


}
