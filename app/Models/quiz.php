<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class quiz extends Model
{
    use HasFactory;

    // protected $table = 'estado';

    // public function questions() {
    //     $questions = DB::table('questao')->get();
    //     return $questions;
    //     // return $this->query->get('*')->all();
    //     // return view('quiz',compact('questions'));
    // }
}
