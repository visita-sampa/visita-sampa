<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = DB::table('questao')->get();
        $alternatives = DB::table('alternativa')->get();
        return view('quiz', compact('questions'), compact('alternatives'));
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

        $insert = DB::insert("insert into respostas (questao_1, questao_2, questao_3, questao_4, questao_5, questao_6, questao_7, questao_8, questao_9, questao_10, questao_11, questao_12, questao_13, questao_14, questao_15) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$answers['question-1'], $answers['question-2'], $answers['question-3'], $answers['question-4'], $answers['question-5'], $answers['question-6'], $answers['question-7'], $answers['question-8'], $answers['question-9'], $answers['question-10'], $answers['question-11'], $answers['question-12'], $answers['question-13'], $answers['question-14'], $answers['question-15']]);

        return redirect()->route('roadMap', app()->getLocale());
        // return $answers;
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
