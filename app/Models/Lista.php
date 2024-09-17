<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Lista extends Model
{
	use HasFactory;

	protected $fillable = [
		'nome',
		'descricao',
		'projeto_id',
		'user_id',
		'tempo_previsto_horas',
		'tempo_previsto_minutos',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function tarefas()
	{
		return $this->hasMany(Tarefa::class);
	}

	public function projeto()
	{
		return $this->belongsTo(Projeto::class);
	}
}