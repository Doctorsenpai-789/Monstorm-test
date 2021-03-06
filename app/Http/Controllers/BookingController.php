<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Booking::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       try {
        $data = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'booking_type' => 'required',
            'phone_number'=> 'required',
            'address'=>'required',
            'status' => 'required',
            'delivery_date' => '',
            'pickup_date' => ''

          
                    
        ]);
       
        $data["user_id"] = Auth::user()->id;

        $booking = Booking::create($data);
      
        $booking->products()->attach([$request->product_id]);
    
        return response()->json(["message" => "Created!"]);

       } catch (\Throwable $e) {

           return "All fields are required".$e;
       }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Booking::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        $booking->update($request->all());
        return $booking;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_booking = Booking::destroy($id);
        return $delete_booking;
    }
}
