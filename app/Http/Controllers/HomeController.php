<?php

namespace App\Http\Controllers;

use App\Item;
use App\Slider;
use App\Contact;
use App\Category;
use App\Reservation;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        $categories = Category::all();
        $items = Item::all();
        return view('welcome', compact('sliders', 'categories', 'items'));
    }

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

    public function contact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        Toastr::success('Sent your message to admin :)', 'success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}
