<?php

namespace App\Http\Controllers;

use App\Models\touristSpot;
use Illuminate\Http\Request;
use Auth;

class TouristSpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('touristSpot');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

        $id_ponto_turistico = null;

        TouristSpot::where('id_ponto_turistico', $id_ponto_turistico)->update(['imagem' => $response]);

        return redirect()->route('touristSpot', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\touristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id = 1)
    {
        Auth::user();
        
        $touristSpot = TouristSpot::where('id_ponto_turistico', $id)->get();

        return view('touristSpot', ['touristSpot' => $touristSpot]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\touristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    public function edit(touristSpot $touristSpot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\touristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, touristSpot $touristSpot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\touristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    public function destroy(touristSpot $touristSpot)
    {
        //
    }
}
