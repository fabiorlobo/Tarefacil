<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
	protected $fillable = ['nome', 'descricao', 'user_id'];

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