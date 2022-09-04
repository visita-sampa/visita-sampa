<?php

namespace App\Http\Controllers;

use App\Models\roadMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Cookie;

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

		$personality = request()->cookie('personality');

		if (Auth::user()) {
			if ($personality != null) {
				DB::table('usuario')
					->where('id_usuario', Auth::user()->id_usuario)
					->update(['fk_classificacao_perfil_roteiro_id_classificacao' => $personality, 'fk_classificacao_perfil_roteiro_id_roteiro' => $personality]);
			}

			$user = DB::table('usuario')
				->where('id_usuario', Auth::user()->id_usuario)
				->get();

			$roadMap = null;

			foreach ($user as $u) {
				$roadMap = $u->fk_classificacao_perfil_roteiro_id_roteiro;
			}

			if ($roadMap == null && $personality == null) {
				return redirect()->route('quiz', app()->getLocale());
			}

			$pontos = DB::select("SELECT * FROM ponto_turistico WHERE fk_roteiro_id_roteiro = $roadMap");
			$roadMapTitle = DB::select("SELECT nome_roteiro FROM classificacao_perfil_roteiro WHERE id_classificacao = $roadMap");
			$roadMapType = DB::select("SELECT descricao FROM classificacao_perfil_roteiro WHERE id_classificacao = $roadMap");
		} else {
			$personality = request()->cookie('personality');

			if ($personality != null) {
				$pontos = DB::select("SELECT * FROM ponto_turistico WHERE fk_roteiro_id_roteiro = $personality");
				$roadMapTitle = DB::select("SELECT nome_roteiro FROM classificacao_perfil_roteiro WHERE id_classificacao = $personality");
				$roadMapType = DB::select("SELECT descricao FROM classificacao_perfil_roteiro WHERE id_classificacao = $personality");
			} else {
				return redirect()->route('quiz', app()->getLocale());
			}
		}

		json_decode(request()->cookie('somethingElse'), true);

		return view('roadMap', ['pontos' => $pontos, 'roadMapType' => $roadMapType, 'roadMapTitle' => $roadMapTitle]);
	}

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
	// public function store(Request $request)
	// {
	//     //
	// }

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\roadMap  $roadMap
	 * @return \Illuminate\Http\Response
	 */
	// public function show(roadMap $roadMap)
	// {
	//     //
	// }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\roadMap  $roadMap
	 * @return \Illuminate\Http\Response
	 */
	// public function edit(roadMap $roadMap)
	// {
	//     //
	// }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\roadMap  $roadMap
	 * @return \Illuminate\Http\Response
	 */
	// public function update(Request $request, roadMap $roadMap)
	// {
	//     //
	// }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\roadMap  $roadMap
	 * @return \Illuminate\Http\Response
	 */
	// public function destroy(roadMap $roadMap)
	// {
	//     //
	// }

	public function calculatePersonalityByCookies()
	{
		$count = [];
		$answers = Session::get('answers');

		$alternatives = DB::select('SELECT * FROM alternativa');
		foreach ($answers as $answer) {
			foreach ($alternatives as $alternative) {
				for ($i = 1; $i <= 15; $i++) {
					if ($answer == $alternative->id_alternativa) {
						array_push($count, $alternative->fk_classificacao_perfil_roteiro_id_classificacao);
					}
				}
			}
		}
		$count = array_count_values($count);
		$count = array_keys($count, max($count));
		$personalidade = $count[0];

		return redirect()->route('roadMap', ['language' => app()->getLocale()])
			->withCookie(cookie("personality", $personalidade, 1440))
			->withCookie(cookie('quiz-answers', json_encode($answers), 1440));
	}
}
