<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminReportController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $postReported = DB::table('publicacao')
    ->join('denuncia', function($join) {
      $join->on('publicacao.id_publicacao', '=', 'denuncia.fk_publicacao_id_publicacao');
    })
    ->join('usuario', function ($join) {
      $join->on('publicacao.fk_usuario_id_usuario', '=', 'usuario.id_usuario');
    })
    ->join('ponto_turistico', function ($join) {
      $join->on('publicacao.fk_ponto_turistico_id_ponto_turistico', '=', 'ponto_turistico.id_ponto_turistico');
    })
    ->distinct('fk_publicacao_id_publicacao')
    ->get();

      // dd($postReported);

    $complaints = DB::table('denuncia')
      ->where('situacao', null)
      ->get();

    $complaintAccepted = DB::table('denuncia')
      ->where('situacao', 1)
      ->get();
      
    $deniedComplaint = DB::table('denuncia')
      ->where('situacao', 0)
      ->get();

    return view('adminReport', ['complaints' => $complaints, 'complaintAccepted' => $complaintAccepted, 'deniedComplaint' => $deniedComplaint, 'postReported' => $postReported]);
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
