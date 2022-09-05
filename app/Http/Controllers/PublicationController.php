<?php

namespace App\Http\Controllers;

use App\Models\complaint;
use App\Models\publication;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

		$post->midia                                    = cloudinary()->upload($request->base64imagePost, array("folder" => "publications", "overwrite" => TRUE, "resource_type" => "image"))->getSecurePath();
		$post->legenda                                  = $request->postDescription;
		$post->data                                     = now();
		$post->fk_usuario_id_usuario                    = Auth::user()->id_usuario;
		$post->fk_ponto_turistico_id_ponto_turistico    = $request->touristSpotId;

		$post->save();

		return redirect()->route('touristSpot.show', ['language' => app()->getLocale(), 'id' => $request->touristSpotId]);
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
	public function update(Request $request, $language, $id = null)
	{
		$post = Publication::find($id);

		if ($request->input('floatingLegend-' . $id)) {
			$post->legenda = $request->input('floatingLegend-' . $id);
		}

		if ($post->save()) {
			$msg = "Sua publicação foi atualizada";
			return redirect()->route('user', app()->getLocale())->with('msgUpdatePostSuccess', $msg);
		} else {
			$msg = "Não foi possível atualizar a publicação. Tente novamente";
			return redirect()->route('user', app()->getLocale())->with('msgUpdatePostFail', $msg);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\publication  $publication
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Request $request)
	{
		$post = Publication::find($request->id);

		foreach (explode('/', $post->midia) as $row) {
			$midia = $row;
		}
		foreach (array_reverse(explode('.', $midia)) as $row) {
			$midia = $row;
		}

		if ($post->delete()) {
			cloudinary()->destroy('publications/' . $midia);
			$response = true;
		} else {
			$response = false;
		}

		return $response;
	}

	public function crop(Request $request)
	{
		$response = $request->file('newPost');

		return response()->json(['status' => 1, 'msg' => 'A imagem foi cortada com sucesso.', 'name' => $response]);
	}

	public function report(Request $request)
	{
		$checkReport = DB::table('denuncia')
			->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
			->where('fk_publicacao_id_publicacao', $request->idPostDenouce)
			->first();
		$report = false;
		if (!$checkReport) {
			$complaint = new Complaint;

			$complaint->motivo                      = $request->motiveDenounces;
			$complaint->fk_usuario_id_usuario       = Auth::user()->id_usuario;
			$complaint->fk_publicacao_id_publicacao = $request->idPostDenouce;

			if ($complaint->save()) {
				$report = true;
			} else {
				$report = false;
			}
		}
		echo json_encode($report);
		return;
	}
}
