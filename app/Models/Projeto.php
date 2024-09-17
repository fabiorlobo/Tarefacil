<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Projeto extends Model
{
	protected $fillable = ['nome', 'descricao', 'user_id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function listas()
	{
		return $this->hasMany(Lista::class);
	}

	public function tarefasPendentes()
	{
		return $this->hasManyThrough(Tarefa::class, Lista::class)
			->where('tarefas.status', false);
	}	

	public function anotacoes()
	{
		return $this->hasMany(Nota::class);
	}
}