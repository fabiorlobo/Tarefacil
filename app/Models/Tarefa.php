<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
	use HasFactory;

	protected $fillable = [
		'descricao',
		'lista_id',
		'tempo_previsto_horas',
		'tempo_previsto_minutos',
		'tempo_utilizado_horas',
		'tempo_utilizado_minutos',
		'status',
		'in_progress',
		'start_time',
	];

	public function lista()
	{
		return $this->belongsTo(Lista::class);
	}
}