<?php

namespace App\Http\Controllers;

use App\Models\feed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FeedController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$checkAnswer = DB::table('usuario_questionario_resposta')
			->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
			->first();

		if($checkAnswer->fk_respostas_id_resposta == null) {
			return redirect()->route('quiz', app()->getLocale());
		}

		$publications = DB::table('publicacao')
			->join('usuario', function ($join) {
				$join->on('publicacao.fk_usuario_id_usuario', '=', 'usuario.id_usuario');
			})
			->join('ponto_turistico', function ($join) {
				$join->on('publicacao.fk_ponto_turistico_id_ponto_turistico', '=', 'ponto_turistico.id_ponto_turistico')
					->where('ponto_turistico.fk_roteiro_id_roteiro', '=', Auth::user()->fk_classificacao_perfil_roteiro_id_classificacao);
			})
			->select('publicacao.id_publicacao', 'publicacao.midia', 'publicacao.legenda', 'publicacao.data', 'usuario.nome_usuario', 'usuario.id_usuario', 'usuario.foto_perfil', 'ponto_turistico.nome_ponto_turistico')
			->where('publicacao.situacao', false)
			->orWhereNull('publicacao.situacao')
			->orderBy('id_publicacao', 'desc')
			->paginate(12);

		if ($request->ajax()) {
			$view = view('feedPublication', ['publications' => $publications])->render();
			return response()->json(['html' => $view]);
		}

		return view('feed', ['publications' => $publications]);
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
	 * @param  \App\Models\feed  $feed
	 * @return \Illuminate\Http\Response
	 */
	// public function show(feed $feed)
	// {
	//     //
	// }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\feed  $feed
	 * @return \Illuminate\Http\Response
	 */
	// public function edit(feed $feed)
	// {
	//     //
	// }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\feed  $feed
	 * @return \Illuminate\Http\Response
	 */
	// public function update(Request $request, feed $feed)
	// {
	//     //
	// }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\feed  $feed
	 * @return \Illuminate\Http\Response
	 */
	// public function destroy(feed $feed)
	// {
	//     //
	// }
}
