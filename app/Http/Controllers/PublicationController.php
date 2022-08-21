<?php

namespace App\Http\Controllers;

use App\Models\publication;
use App\Models\complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $post = new Publication;

        $post->midia                                    = cloudinary()->upload($request->fileAux)->getSecurePath();
        $post->legenda                                  = $request->postDescription;
        $post->data                                     = now();
        $post->fk_usuario_id_usuario                    = Auth::user()->id_usuario;
        $post->fk_ponto_turistico_id_ponto_turistico    = $request->touristSpotId;

        $post->save();

        return redirect()->route('touristSpot.show', ['language'=>app()->getLocale(), 'id'=>$request->touristSpotId]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\publication  $publication
     * @return \Illuminate\Http\Response
     */
    // public function show(publication $publication)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\publication  $publication
     * @return \Illuminate\Http\Response
     */
    // public function edit(publication $publication)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\publication  $publication
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, publication $publication)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\publication  $publication
     * @return \Illuminate\Http\Response
     */
    // public function destroy(publication $publication)
    // {
    //     //
    // }

    public function crop(Request $request)
    {
        $response = $request->file('newPost');

        return response()->json(['status' => 1, 'msg' => 'A imagem foi cortada com sucesso.', 'name' => $response]);
    }

    public function report(Request $request)
    {
        $complaint = new Complaint;

        $complaint->motivo                      = $request->motiveDenounces;
        $complaint->fk_usuario_id_usuario       = Auth::user()->id_usuario;
        $complaint->fk_publicacao_id_publicacao = $request->idPostDenouce;

        if($complaint->save()) {
            $report['success']  = true;
            $report['message']  = 'A publicação foi reportada com sucesso. Enviaremos sua denúncia para análise dos administradores. Agradecemos sua colaboração!';
        }
        else {
            $report['success']  = false;
            $report['message']  = 'A publicação não foi reportada. Algo inesperado aconteceu, tente novamente.';
        }

        echo json_encode($report);
        return;
    }
}
