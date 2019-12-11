<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlightCollection;
use App\Http\Resources\FlightResource;
use App\Model\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Flight $flight
     * @return FlightCollection
     */
    public function index(Flight $flight)
    {
        return  new FlightCollection($flight->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  $flight
     * @return \Illuminate\Http\Response
     */
    public function show(Flight $flight)
    {
        return  new FlightResource($flight);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flight = Flight::create($request->all());

        return new FlightResource($flight);
    }


    /**
     * @param Request $request
     * @param Flight $flight
     * @return FlightResource
     */
    public function update(Request $request, Flight $flight)
    {
        $flight->update($request->all());

        return new FlightResource($flight);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = Flight::find($id);

        if ($flight) {
            $flight->delete();
        }

        return response()->json(['data' => 'Resource has been deleted']);
    }
}
