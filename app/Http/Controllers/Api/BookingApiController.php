<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;

class BookingApiController extends Controller
{
    /**
     * Store a newly created booking via API
     */
    public function store(StoreBookingRequest $request): JsonResponse
    {
        $booking = Booking::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'service' => $request->service,
            'date' => $request->date,
            'time' => $request->time,
            'special_request' => $request->special_request,
            'payment_method' => $request->payment_method,
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $booking->id,
                'booking_reference' => $booking->booking_reference,
                'status' => $booking->status,
                'date' => $booking->date->format('Y-m-d'),
                'time' => $booking->time,
                'name' => $booking->full_name,
            ],
        ], 201);
    }

    /**
     * Get a booking by ID via API
     */
    public function show(Booking $booking): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $booking->id,
                'full_name' => $booking->full_name,
                'email' => $booking->email,
                'phone' => $booking->phone,
                'service' => $booking->service,
                'date' => $booking->date->format('Y-m-d'),
                'time' => $booking->time,
                'booking_reference' => $booking->booking_reference,
                'status' => $booking->status,
                'payment_method' => $booking->payment_method,
                'created_at' => $booking->created_at->toIso8601String(),
            ],
        ], 200);
    }
}