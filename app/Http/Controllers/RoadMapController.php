<?php

namespace App\Http\Controllers;

use App\Models\roadMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoadMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternatives = DB::select('SELECT * FROM alternativa');
        $answers = DB::select('SELECT * FROM respostas ORDER BY id_resposta DESC LIMIT 1');
        $count = [];
        foreach ($answers as $answer) {
            foreach ($alternatives as $alternative) {
                for ($i = 1; $i <= 15; $i++) {
                    $resp = "questao_" . $i;
                    if ($answer->$resp == $alternative->id_alternativa) {
                        array_push($count, $alternative->fk_classificacao_perfil_roteiro_id_classificacao);
                    }
                }
            }
        }
        $count = array_count_values($count);
        $count = array_keys($count, max($count));
        $personalidade = $count[0];

        $pontos = DB::select("SELECT * FROM ponto_turistico WHERE fk_roteiro_id_roteiro = $personalidade");
        return view('roadMap', ['pontos' => $pontos]);
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
     * @param  \App\Models\roadMap  $roadMap
     * @return \Illuminate\Http\Response
     */
    public function show(roadMap $roadMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\roadMap  $roadMap
     * @return \Illuminate\Http\Response
     */
    public function edit(roadMap $roadMap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\roadMap  $roadMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, roadMap $roadMap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\roadMap  $roadMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(roadMap $roadMap)
    {
        //
    }
}
