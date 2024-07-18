<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
	use HasFactory;

	protected $fillable = [
		'nome',
		'descricao',
		'projeto_id',
		'tempo_previsto_horas',
		'tempo_previsto_minutos',
	];
	public function tarefas()
	{
			return $this->hasMany(Tarefa::class);
	}

	public function projeto()
	{
		return $this->belongsTo(Projeto::class);
	}
}