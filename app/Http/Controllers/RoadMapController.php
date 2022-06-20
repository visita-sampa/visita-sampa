<?php

namespace App\Http\Controllers;

use App\Models\roadMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class RoadMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!Auth::user()) {
        //     return redirect()->route('login', app()->getLocale());
        // }

        $alternatives = DB::select('SELECT * FROM alternativa');

        $answers = DB::table('respostas')
            ->join('usuario_questionario_resposta', function ($join) {
                $join->on('respostas.id_resposta', '=', 'usuario_questionario_resposta.fk_respostas_id_resposta')
                    ->where('usuario_questionario_resposta.fk_usuario_id_usuario', '=', 29);
                // ->where('usuario_questionario_resposta.fk_usuario_id_usuario', '=', Auth::user()->id_usuario);
            })
            ->get();

        if (!$answers->isEmpty()) {
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

            if (Auth::user()) {
                DB::table('usuario')
                    ->where('id_usuario', Auth::user()->id_usuario)
                    ->update(['fk_classificacao_perfil_roteiro_id_classificacao' => $personalidade, 'fk_classificacao_perfil_roteiro_id_roteiro' => $personalidade,]);
            }

            $pontos = DB::select("SELECT * FROM ponto_turistico WHERE fk_roteiro_id_roteiro = $personalidade");

            return view('roadMap', ['pontos' => $pontos]);
        } else {
            return redirect()->route('quiz', app()->getLocale());
        }
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
