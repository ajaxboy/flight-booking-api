<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Booking;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;
Use \Carbon\Carbon;


class BookingController extends Controller
{
    /**
     * @param Booking $booking
     * @return BookingCollection
     */
    public function index(Booking $booking)
    {
        return new BookingCollection($booking->all());
    }

    /**
     * @param Booking $booking
     * @return BookingResource
     */
    public function show(Booking $booking)
    {
        return new BookingResource($booking);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = Booking::create(array_merge($request->all(),[
            'reservation_time' => Carbon::now('US/Central')->toDate()
        ]));

        return new BookingResource($booking);
    }

    /**
     * @param Booking $booking
     * @param Request $request
     * @return BookingResource
     */
    public function update(Booking $booking, Request $request)
    {
        $booking->update($request->all());

        return new BookingResource($booking);
    }

    /**
     * @param Booking $booking
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $booking = Booking::where('id',$id)->first();
        if ($booking != null) {
            $booking->delete();
        }

        return response()->json([
            'data' => 'Resource has been deleted'
        ]);
    }
}
