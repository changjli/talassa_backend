<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reservations = Reservation::all();
            return response()->json(['success' => true, 'data' => $reservations]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function available(Request $request)
    {
        try {
            $reservations = Reservation::where('available', true)
                ->where('date', $request->d)
                ->where('shift_id', $request->s)
                ->whereHas('table', function ($q) use ($request) {
                    $q->whereHas('restaurant', function ($q) use ($request) {
                        $q->where('branch', $request->b)->where('location', $request->l);
                    });
                })->get();
            return response()->json(['success' => true, 'data' => $reservations]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function booked()
    {
        try {
            $reservations = Reservation::where('available', false)->get();
            return response()->json(['success' => true, 'data' => $reservations]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
