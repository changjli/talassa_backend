<?php

namespace App\Http\Controllers;

use App\Mail\BookingMail;
use App\Models\Booking;
use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BookingApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'adults' => 'required',
                'child' => 'required',
                'gender' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'specialRequest' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()]);
            }

            $reservation = Reservation::where('id', $request->reservation_id)->first();

            if (!$reservation->available) {
                return response()->json(['success' => false, 'message' => 'Sorry, table has been booked']);
            }

            $booking = Booking::create([
                'adults' => $request->adults,
                'child' => $request->child,
                'gender' => $request->gender,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'request' => $request->specialRequest,
                'reservation_id' => $request->reservation_id,
                'completed' => false,
            ]);

            $reservation->update([
                'available' => false
            ]);

            Mail::to($request->email)->send(new BookingMail($booking));

            return response()->json(['success' => true, 'data' => $booking]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
