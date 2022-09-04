<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\explore;
use App\Models\publication;
use App\Models\touristSpot;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $publications = DB::table('publicacao')
            ->join('usuario', function ($join) {
                $join->on('publicacao.fk_usuario_id_usuario', '=', 'usuario.id_usuario');
            })
            ->join('ponto_turistico', function ($join) {
                $join->on('publicacao.fk_ponto_turistico_id_ponto_turistico', '=', 'ponto_turistico.id_ponto_turistico');
            })
            ->select('publicacao.id_publicacao', 'publicacao.midia', 'publicacao.legenda', 'ponto_turistico.nome_ponto_turistico', 'publicacao.data', 'publicacao.updated_at', 'usuario.nome', 'usuario.nome_usuario', 'usuario.id_usuario', 'usuario.foto_perfil')
            ->where('publicacao.situacao', false)
            ->orWhereNull('publicacao.situacao')
            ->orderBy('id_publicacao', 'desc')
            ->paginate(12);

						date_default_timezone_set('America/Sao_Paulo');

						$now = time();
				
						foreach ($publications as $post) {
							if ($post->data != $post->updated_at) {
								$post->updated_at = round(($now - strtotime($post->updated_at)) / (60 * 60 * 24));
							} 
							else {
								$post->data = round(($now - strtotime($post->data)) / (60 * 60 * 24));
							}
						}

        // dd($request->all());
        // search profiles or tourist spots
        $search = $request->search;
        $typeSearch = "";

        $touristSpot = DB::table('ponto_turistico')
            ->select('ponto_turistico.id_ponto_turistico', 'ponto_turistico.nome_ponto_turistico')
            ->orderBy('nome_ponto_turistico', 'asc')
            ->paginate(12, ['*'], 'touristSpotSearchPage');

        $profiles = DB::table('usuario')
            ->select('usuario.id_usuario', 'usuario.nome', 'usuario.nome_usuario')
            ->orderBy('nome', 'asc')
            ->paginate(12, ['*'], 'profileSearchPage');

        $publications->appends(['page' => $publications->currentPage()])->links();

        $touristSpot->appends(['touristSpotSearchPage' => $touristSpot->currentPage()])->links();

        $profiles->appends(['profileSearchPage' => $profiles->currentPage()])->links();

        if ($search) {
            if ($request->typeSearch == 1) {
                $touristSpot = DB::table('ponto_turistico')
                    ->select('ponto_turistico.id_ponto_turistico', 'ponto_turistico.nome_ponto_turistico')
                    ->where('nome_ponto_turistico', 'ilike', '%' . $search . '%')
                    ->orderBy('nome_ponto_turistico', 'asc')
                    ->get();
                $typeSearch = "pontos turísticos";
            } elseif ($request->typeSearch == 2) {
                $profiles = DB::table('usuario')
                    ->select('usuario.id_usuario', 'usuario.nome', 'usuario.nome_usuario')
                    ->where('nome', 'ilike', '%' . $search . '%')
                    ->orWhere('nome_usuario', 'ilike', '%' . $search . '%')
                    ->orderBy('nome', 'asc')
                    ->get();
                $typeSearch = "perfis";
            }
        }

        if ($request->ajax()) {
            $view = view('explorePublication', ['publications' => $publications])->render();
            $touristSpotContent = view('searchTouristSpot', ['touristSpot' => $touristSpot])->render();
            $profileContent = view('searchProfile', ['profiles' => $profiles])->render();

            return response()->json(['html' => $view, 'htmlSearchTouristSpot' => $touristSpotContent, 'htmlSearchProfile' => $profileContent]);
        }

        return view('explore', ['publications' => $publications, 'touristSpot' => $touristSpot, 'profiles' => $profiles, 'search' => $search, 'typeSearch' => $typeSearch]);
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
     * @param  \App\Models\explore  $explore
     * @return \Illuminate\Http\Response
     */
    // public function show(explore $explore)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\explore  $explore
     * @return \Illuminate\Http\Response
     */
    // public function edit(explore $explore)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\explore  $explore
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, explore $explore)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\explore  $explore
     * @return \Illuminate\Http\Response
     */
    // public function destroy(explore $explore)
    // {
    //     //
    // }
}
