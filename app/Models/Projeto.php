<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
	use HasFactory;

	protected $fillable = [
		'nome',
		'descricao',
	];

	public function listas()
	{
		return $this->hasMany(Lista::class);
	}

	public function notas()
	{
		return $this->hasMany(Nota::class);
	}
}