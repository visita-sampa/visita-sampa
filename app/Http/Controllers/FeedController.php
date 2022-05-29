<?php

namespace App\Http\Controllers;

use App\Models\feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
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
        $id_user = [];
        $msg = "";
        $msg_user = "";
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
        foreach ($pontos as $ponto) {
            $msg .= "fk_ponto_turistico_id_ponto_turistico = " . $ponto->id_ponto_turistico . " OR ";
        }
        $msg = substr_replace($msg, '', -4);
        $posts = DB::select("SELECT * FROM publicacao WHERE $msg");
        if (!empty($posts)) {
            foreach ($posts as $post) {
                if (!in_array($post->fk_usuario_id_usuario, $id_user)) {
                    $msg_user .= "id_usuario = " . $post->fk_usuario_id_usuario . " OR ";
                    array_push($id_user, $post->fk_usuario_id_usuario);
                }
            }
            $msg_user = substr_replace($msg_user, '', -4);
            $user = DB::select("SELECT * FROM usuario WHERE $msg_user");
            return view('feed', ['posts' => $posts, 'users' => $user]);
        }
        return view('feed', ['posts' => $posts]);
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
     * @param  \App\Models\feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, feed $feed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(feed $feed)
    {
        //
    }
}
