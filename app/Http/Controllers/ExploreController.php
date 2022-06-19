<?php

namespace App\Http\Controllers;

use App\Models\explore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;
use App\Models\User;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('login', app()->getLocale());
        }

        $publications = DB::table('publicacao')
        ->join('usuario', function ($join) {
            $join->on('publicacao.fk_usuario_id_usuario', '=', 'usuario.id_usuario');
        })
        ->join('ponto_turistico', function ($join) {
            $join->on('publicacao.fk_ponto_turistico_id_ponto_turistico', '=', 'ponto_turistico.id_ponto_turistico');
        })
        ->select('publicacao.id_publicacao', 'publicacao.midia', 'publicacao.legenda', 'ponto_turistico.nome_ponto_turistico', 'publicacao.data', 'usuario.nome', 'usuario.nome_usuario', 'usuario.id_usuario', 'usuario.foto_perfil')
        ->orderBy('id_publicacao', 'desc')
        ->get();

        date_default_timezone_set('America/Sao_Paulo');

        $now = time(); 
        
        foreach($publications as $post) {
            $post->data = round(($now - strtotime($post->data)) / (60 * 60 * 24));
        }

        return view('explore', ['publications' => $publications]);
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
