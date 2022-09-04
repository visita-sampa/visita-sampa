<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publication extends Model
{
  use HasFactory;

  protected $table = 'publicacao';
  protected $primaryKey = 'id_publicacao';

  protected $fillable = [
    'midia',
    'legenda',
    'data',
    'fk_usuario_id_usuario',
    'fk_ponto_turistico_id_ponto_turistico',
  ];
}
