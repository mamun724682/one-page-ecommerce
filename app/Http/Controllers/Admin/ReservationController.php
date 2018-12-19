<?php

namespace App\Http\Controllers\Admin;

use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ReservationController extends Controller
{
    public function index()
    {
    	$reservations = Reservation::all();
    	return view('admin.reservation.index', compact('reservations'));
    }

    public function status($id)
    {
    	$reserve = Reservation::find($id);
    	$reserve->status = true;
    	$reserve->save();

    	Toastr::success('Reservation request Acceptd', 'success', ["positionClass" => "toast-top-right"]);

    	return redirect()->back();
    }

    public function destroy($id)
    {
    	Reservation::find($id)->delete();

    	Toastr::success('Reservation request Deleted', 'success', ["positionClass" => "toast-top-right"]);

    	return redirect()->back();
    }
}
