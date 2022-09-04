<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
  use HasFactory;

  protected $table = 'respostas';
  protected $primaryKey = 'id_resposta';

  protected $fillable = [
    'questao_1',
    'questao_2',
    'questao_3',
    'questao_4',
    'questao_5',
    'questao_6',
    'questao_7',
    'questao_8',
    'questao_9',
    'questao_10',
    'questao_11',
    'questao_12',
    'questao_13',
    'questao_14',
    'questao_15',
  ];
}
