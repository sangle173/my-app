<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TicketStatus;
use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    public function AllTicketStatus()
    {

        $ticket_status = TicketStatus::latest()->get();
        return view('admin.backend.ticket_status.all_ticket_status', compact('ticket_status'));

    }// End Method

    public function AddTicketStatus()
    {
        return view('admin.backend.ticket_status.add_ticket_status');
    }// End Method

    public function StoreTicketStatus(Request $request)
    {

        TicketStatus::insert([
            'ticket_status_name' => $request->ticket_status_name,
            'color' => $request->color,
            'ticket_status_slug' => strtolower(str_replace(' ', '-', $request->ticket_status_name)),
        ]);

        $notification = array(
            'message' => 'Ticket Status Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.ticketstatus')->with($notification);

    }// End Method

    public function EditTicketStatus($id)
    {

        $ticket_status = TicketStatus::find($id);
        return view('admin.backend.ticket_status.edit_ticket_status', compact('ticket_status'));
    }// End Method

    public function UpdateTicketStatus(Request $request)
    {

        $ticket_status_id = $request->id;
        TicketStatus::find($ticket_status_id)->update([
            'ticket_status_name' => $request-> ticket_status_name,
            'color' => $request->color,
            'ticket_status_slug' => strtolower(str_replace(' ', '-', $request-> ticket_status_name)),
        ]);

        $notification = array(
            'message' => 'Ticket Status Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.ticketstatus')->with($notification);
    }// End Method


    public function DeleteTicketStatus($id)
    {

        TicketStatus::find($id)->delete();

        $notification = array(
            'message' => 'Ticket Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method
}
