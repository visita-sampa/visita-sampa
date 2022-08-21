<?php

namespace App\Http\Controllers;

use App\Models\touristSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class TouristSpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('touristSpot');
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
    public function store(Request $request)
    {
        $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

        $id_ponto_turistico = null;

        TouristSpot::where('id_ponto_turistico', $id_ponto_turistico)->update(['imagem' => $response]);

        return redirect()->route('touristSpot', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\touristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $language, $id = 1)
    {
        if (!Auth::user()) {
            return redirect()->route('login', app()->getLocale());
        }

        // $touristSpot = TouristSpot::where('id_ponto_turistico', $id)->get();
        $touristSpot = DB::table('ponto_turistico')
            ->join('endereco', function ($join) {
                $join->on('ponto_turistico.fk_endereco_id_endereco', '=', 'endereco.id_endereco');
            })
            ->join('bairro', function ($join) {
                $join->on('endereco.fk_bairro_id_bairro', '=', 'bairro.id_bairro');
            })
            ->join('cidade', function ($join) {
                $join->on('bairro.fk_cidade_id_cidade', '=', 'cidade.id_cidade');
            })
            ->join('estado', function ($join) {
                $join->on('cidade.fk_estado_id_estado', '=', 'estado.id_estado');
            })
            ->where('ponto_turistico.id_ponto_turistico', '=', $id)
            ->select('ponto_turistico.id_ponto_turistico', 'ponto_turistico.nome_ponto_turistico', 'ponto_turistico.informacoes', 'ponto_turistico.imagem', 'endereco.logradouro', 'endereco.cep', 'endereco.numero', 'endereco.complemento', 'bairro.nome_bairro', 'cidade.nome_cidade', 'estado.nome_estado')
            ->get();

        $publications = DB::table('publicacao')
            ->join('usuario', function ($join) {
                $join->on('publicacao.fk_usuario_id_usuario', '=', 'usuario.id_usuario');
            })
            ->where('publicacao.fk_ponto_turistico_id_ponto_turistico', '=', $id)
            ->select('publicacao.id_publicacao', 'publicacao.midia', 'publicacao.legenda', 'publicacao.data', 'usuario.nome_usuario', 'usuario.id_usuario', 'usuario.foto_perfil')
            ->orderBy('id_publicacao', 'desc')
            ->paginate(12);

        if ($request->ajax()) {
            $view = view('touristSpotPublication', ['publications' => $publications])->render();
            return response()->json(['html' => $view]);
        }

        return view('touristSpot', ['touristSpot' => $touristSpot, 'publications' => $publications]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\touristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    // public function edit(touristSpot $touristSpot)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\touristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, touristSpot $touristSpot)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\touristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    // public function destroy(touristSpot $touristSpot)
    // {
    //     //
    // }
}
