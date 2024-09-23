<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Projeto;

class Nota extends Model
{
	use HasFactory;

	protected $fillable = [
		'nome',
		'descricao',
		'nota',
		'projeto_id',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function projeto()
	{
		return $this->belongsTo(Projeto::class);
	}
}