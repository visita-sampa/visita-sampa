<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now = now()->format('Y-m-d');

        $events = DB::table('eventos')
            ->where('data_evento', '>', $now)
            ->paginate(12);

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $now = time();

        foreach ($events as $event) {
            $event->data_evento = strftime('%A, %d de %B de %Y', strtotime($event->data_evento));
        }

        if ($request->ajax()) {
            $view = view('eventDivulgation', ['events' => $events])->render();
            return response()->json(['html' => $view]);
        }

        return view('event', ['events' => $events]);
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
        $event = new Event;

        $event->nome                                    = $request->title;
        $event->link                                    = $request->link;
        $event->informacoes                             = $request->description;
        $event->fk_administrador_id_administrador       = 1;
        $event->fk_administrador_fk_usuario_id_usuario  = 1;

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->imagem = $imageName;
        }

        $event->save();

        return redirect()->route('event', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    // public function show(event $event)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    // public function edit(event $event)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, event $event)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    // public function destroy(event $event)
    // {
    //     //
    // }
}
