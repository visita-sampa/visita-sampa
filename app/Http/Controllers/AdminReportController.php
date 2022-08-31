<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // DB::table('denuncia')
    // ->where('', Auth::user()->id_usuario)
    // ->update(['fk_respostas_id_resposta' => $answer->id_resposta]);


    return view('adminReport');
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
   * @param  \App\Models\event  $event
   * @return \Illuminate\Http\Response
   */
  public function show(event $event)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\event  $event
   * @return \Illuminate\Http\Response
   */
  public function edit(event $event)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\event  $event
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, event $event)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\event  $event
   * @return \Illuminate\Http\Response
   */
  public function destroy(event $event)
  {
    //
  }
}