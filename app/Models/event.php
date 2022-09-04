<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class event extends Model
{
	use HasFactory;

	protected $table = 'eventos';
	protected $primaryKey = 'id_evento';

	protected $fillable = [
		'nome',
		'link',
		'informacoes',
		'imagem',
		'data_evento',
		'local_evento',
		'fk_administrador_id_administrador',
		'fk_administrador_fk_usuario_id_usuario'
	];
}
