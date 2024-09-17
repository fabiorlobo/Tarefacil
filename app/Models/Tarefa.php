<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
		'user_id',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function lista()
	{
		return $this->belongsTo(Lista::class);
	}
}