<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ReservationController extends Controller
{
    public function reserve(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'phone' => 'required',
    		'email' => 'required',
    		'dateandtime' => 'required',
    	]);

    	$reserve = new Reservation;
    	$reserve->name = $request->name;
    	$reserve->phone = $request->phone;
    	$reserve->email = $request->email;
    	$reserve->date_and_time = $request->dateandtime;
    	$reserve->message = $request->message;
    	$reserve->status = false;
    	$reserve->save();

    	Toastr::success('Reservation request sent, We will confirm to you asaf', 'success', ["positionClass" => "toast-top-right"]);

    	return redirect()->back();
    }
}
