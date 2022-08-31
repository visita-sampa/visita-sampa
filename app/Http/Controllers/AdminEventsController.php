<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminEventsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('adminEvents');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  // public function create()
  // {
  //   //
  // }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $local = $request->event_road . " " . $request->event_number . ", " . $request->event_complement . " - " . $request->event_district . " - " . $request->event_cep;
    $event = new event;

    $event->nome = $request->event_name;
    $event->link = $request->event_link;
    $event->imagem = cloudinary()->upload($request->picture__input_aux, array("folder" => "events", "overwrite" => TRUE, "resource_type" => "image"))->getSecurePath();
    $event->data_evento = $request->event_date;
    $event->local_evento = $local;
    $event->fk_administrador_id_administrador = $this->searchAdminId();
    $event->fk_administrador_fk_usuario_id_usuario = Auth::user()->id_usuario;


    $event->save();
    return redirect()->route('adminEvents', app()->getLocale());
  }

  public function searchAdminId()
  {
    $id = DB::table('administrador')
      ->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
      ->first();
    return $id->id_administrador;
  }


  /**
   * Display the specified resource.
   *
   * @param  \App\Models\event  $event
   * @return \Illuminate\Http\Response
   */
  // public function show(event $event)
  // {
  //   //
  // }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\event  $event
   * @return \Illuminate\Http\Response
   */
  // public function edit(event $event)
  // {
  //   //
  // }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\event  $event
   * @return \Illuminate\Http\Response
   */
  // public function update(Request $request, event $event)
  // {
  //   //
  // }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\event  $event
   * @return \Illuminate\Http\Response
   */
  // public function destroy(event $event)
  // {
  //   //
  // }
}
