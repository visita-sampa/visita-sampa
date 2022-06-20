<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use App\Models\answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class QuizController extends Controller
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
        $answer = DB::table('usuario_questionario_resposta')->where('fk_usuario_id_usuario', 29)->whereNotNull('fk_respostas_id_resposta')->get();
        // $answer = DB::table('usuario_questionario_resposta')->where('fk_usuario_id_usuario', Auth::user()->id_usuario)->whereNotNull('fk_respostas_id_resposta')->get();
        $questions = DB::table('questao')->get();
        $alternatives = DB::table('alternativa')->get();
        return view('quiz', ['questions' => $questions, 'alternatives' => $alternatives, 'answer' => $answer]);
        // $data = quiz::query()->questions();
        // $data = quiz::where('id_estado', 1);
        // $data = quiz::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 'enviou';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answers = $request->all();

        $answers = array_slice($answers, 1, 15);

        $answer = new Answer;

        $answer->questao_1 = $answers['question-1'];
        $answer->questao_2 = $answers['question-2'];
        $answer->questao_3 = $answers['question-3'];
        $answer->questao_4 = $answers['question-4'];
        $answer->questao_5 = $answers['question-5'];
        $answer->questao_6 = $answers['question-6'];
        $answer->questao_7 = $answers['question-7'];
        $answer->questao_8 = $answers['question-8'];
        $answer->questao_9 = $answers['question-9'];
        $answer->questao_10 = $answers['question-10'];
        $answer->questao_11 = $answers['question-11'];
        $answer->questao_12 = $answers['question-12'];
        $answer->questao_13 = $answers['question-13'];
        $answer->questao_14 = $answers['question-14'];
        $answer->questao_15 = $answers['question-15'];

        $answer->save();

        DB::table('usuario_questionario_resposta')
            ->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
            ->update(['fk_respostas_id_resposta' => $answer->id_resposta]);

        return redirect()->route('roadMap', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(quiz $quiz)
    {
        //
    }
}
