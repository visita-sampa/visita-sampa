<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class touristSpot extends Model
{
    use HasFactory;

    protected $table = 'ponto_turistico';
    protected $primaryKey = 'id_ponto_turistico';

    protected $fillable = [
        'nome',
        'informacoes',
        'imagem',
        'fk_roteiro_id_roteiro',
        'fk_endereco_id_endereco',
    ];
}
