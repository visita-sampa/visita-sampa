<?php

namespace App\Http\Controllers;

use App\Models\explore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pontos = DB::table('ponto_turistico')->get();
        return view('explore', compact('pontos'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\explore  $explore
     * @return \Illuminate\Http\Response
     */
    public function show(explore $explore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\explore  $explore
     * @return \Illuminate\Http\Response
     */
    public function edit(explore $explore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\explore  $explore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, explore $explore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\explore  $explore
     * @return \Illuminate\Http\Response
     */
    public function destroy(explore $explore)
    {
        //
    }
}
