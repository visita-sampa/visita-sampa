<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complaint extends Model
{
	use HasFactory;

	protected $table = 'denuncia';
	protected $primaryKey = 'id_denuncia';

	protected $fillable = [
		'fk_usuario_id_usuario',
		'fk_publicacao_id_publicacao',
		'motivo'
	];
}
