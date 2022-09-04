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
    // get posts with complaint
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

    // set formatted date
    date_default_timezone_set('America/Sao_Paulo');
    $now = time();

    foreach ($postReported as $post) {
      $post->data = round(($now - strtotime($post->data)) / (60 * 60 * 24));
    }

    // get complaints without response
    $complaints = DB::table('denuncia')
      ->where('situacao', null)
      ->get();

    $activeComplaint = $this->calculateComplaints($postReported, $complaints);
    
    // get accepted complaints
    $complaintAccepted = DB::table('denuncia')
      ->where('situacao', true)
      ->get();
    
    // $postComplaintAccepted = $this->calculateComplaintsAccepted($postReported, $complaintAccepted);
    $postComplaintAccepted = $this->calculateComplaints($postReported, $complaintAccepted);
    
    // get denied complaints
    $deniedComplaint = DB::table('denuncia')
      ->where('situacao', false)
      ->get();

    $postComplaintDenied = $this->calculateComplaints($postReported, $deniedComplaint);

    return view('adminReport', ['complaints' => $complaints, 'complaintAccepted' => $complaintAccepted, 'deniedComplaint' => $deniedComplaint, 'postReported' => $activeComplaint, 'postComplaintAccepted' => $postComplaintAccepted, 'postComplaintDenied' => $postComplaintDenied]);
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
  // public function store(Request $request)
  // {
  //   //
  // }

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

  public function calculateComplaints($postReported, $complaints) {
    $activeComplaint = [];

    foreach($postReported as $post) {
      $cont = 0;
      foreach($complaints as $report) {
        if($report->fk_publicacao_id_publicacao == $post->id_publicacao) {
          $cont++;
        }
      }

      if($cont >= 2) {
        array_push($activeComplaint, $post);
      }
    }

    return $activeComplaint;
  }

  public function acceptComplaint(Request $request) {
    if($request->response == 'accept') {
      DB::table('publicacao')->where('id_publicacao', $request->publication)->update(['situacao' => true]);

      DB::table('denuncia')->where('fk_publicacao_id_publicacao', $request->publication)->update(['situacao' => true]);
    }
    else {
      DB::table('publicacao')->where('id_publicacao', $request->publication)->update(['situacao' => null]);
    }
    
    return;
  }
  
  public function refuseComplaint(Request $request) {
    if($request->response == 'refuse') {
      DB::table('publicacao')->where('id_publicacao', $request->publication)->update(['situacao' => false]);
      
      DB::table('denuncia')->where('fk_publicacao_id_publicacao', $request->publication)->update(['situacao' => false]);
    }
    else {
      DB::table('publicacao')->where('id_publicacao', $request->publication)->update(['situacao' => null]);
    }
    
    return;
  }
}
